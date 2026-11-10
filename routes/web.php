<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Complaint;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MessageController;

use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| OTP Routes (Guest)
|--------------------------------------------------------------------------
*/

Route::get('/verify-otp', function () {
    return view('auth.verify-otp');
})->name('verify.otp');

Route::post('/verify-otp', [AuthController::class, 'verify']);

Route::get('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {

        $userId = Auth::id();

        return view('user.dashboard', [
            'total' => \App\Models\Complaint::where('user_id', $userId)->count(),
            'resolved' => \App\Models\Complaint::where('user_id', $userId)
                ->where('status', 'resolved')->count(),
            'pending' => \App\Models\Complaint::where('user_id', $userId)
                ->where('status', 'pending')->count(),
            'inProgress' => \App\Models\Complaint::where('user_id', $userId)
                ->where('status', 'in_progress')->count(),
        ]);
    })->middleware('auth')->name('user.dashboard');

    // Profile
    Route::get('/user/profile', function () {
        return view('user.profile');
    })->name('user.profile');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update.custom');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Settings

    Route::get('/settings', function () {

        $resolvedCount = \App\Models\Complaint::where('user_id', Auth::id())
            ->where('status', 'resolved')
            ->count();

        return view('user.settings', compact('resolvedCount'));
    })->middleware('auth')->name('settings');

    Route::post('/settings/notifications', function (\Illuminate\Http\Request $request) {
        $user = Auth::user();

        if ($user instanceof \App\Models\User) {
            $user->email_alerts = $request->email_alerts ? 1 : 0;
            $user->city_alerts = $request->city_alerts ? 1 : 0;

            $user->save();
        }

        return back()->with('success', 'Settings updated');
    })->name('settings.notifications');

    /*
    |--------------------------------------------------------------------------
    | Complaint System (User Side)
    |--------------------------------------------------------------------------
    */

    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{id}', [ComplaintController::class, 'show'])
        ->name('complaints.show');
    Route::post('/complaints/{id}/rate', [ComplaintController::class, 'rate'])->name('complaints.rate');
    Route::post('/complaints/{id}/reopen', [ComplaintController::class, 'reopen'])->name('complaints.reopen');
    Route::get('/complaints/{id}/pdf', [ComplaintController::class, 'download'])->name('complaints.pdf');

    Route::get('/feedback/{id}', [ComplaintController::class, 'feedbackForm'])->name('feedback.form');
    Route::post('/feedback/{id}', [ComplaintController::class, 'submitFeedback'])->name('feedback.submit');
    Route::post('/complaints/{id}/rate', [ComplaintController::class, 'rate'])->name('complaints.rate');



    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');

    // User message route — user group ke andar
    Route::post('/complaints/{complaintId}/messages', [MessageController::class, 'userSend'])->name('messages.user.send');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $last7Days = collect(range(6, 0))->map(function ($i) {
            $date = now()->subDays($i)->format('Y-m-d');
            return [
                'date'  => now()->subDays($i)->format('d M'),
                'count' => \App\Models\Complaint::whereDate('created_at', $date)->count(),
            ];
        });

        $categoryStats = \App\Models\Complaint::selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->get();

        $recentComplaints = \App\Models\Complaint::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'pending'          => \App\Models\Complaint::where('status', 'pending')->count(),
            'inProgress'       => \App\Models\Complaint::where('status', 'in_progress')->count(),
            'resolved'         => \App\Models\Complaint::where('status', 'resolved')->count(),
            'critical'         => \App\Models\Complaint::where('priority', 'high')->count(),
            'totalCities'      => \App\Models\City::count(),
            'totalPopulation'  => \App\Models\City::sum('population'),
            'last7Days'        => $last7Days,
            'categoryStats'    => $categoryStats,
            'recentComplaints' => $recentComplaints,
        ]);
    })->name('admin.dashboard');

    // Charts
    Route::get('/charts', function () {
        return view('admin.charts', [
            'pending' => \App\Models\Complaint::where('status', 'pending')->count(),
            'inProgress' => \App\Models\Complaint::where('status', 'in_progress')->count(),
            'resolved' => \App\Models\Complaint::where('status', 'resolved')->count(),
        ]);
    })->name('admin.charts');

    // Reports
    Route::get('/reports', function () {
        return view('admin.reports');
    });

    // PDF Download
    Route::get('/download-pdf', function () {
        $data = ['complaints' => Complaint::all()];
        $pdf = Pdf::loadView('admin.pdf', $data);
        return $pdf->download('report.pdf');
    });



    // Admin Pages
    Route::get('/complaints', [ComplaintController::class, 'adminIndex'])->name('admin.complaints');
    Route::get('/admin/complaints/{id}', [ComplaintController::class, 'adminShow'])
        ->name('admin.complaints.show');
    Route::get('/search', [SearchController::class, 'adminIndex'])->name('admin.search');
    Route::get('/filters', [FilterController::class, 'index'])->name('admin.filters');
    Route::get('/map', [MapController::class, 'index'])->name('admin.map');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');
    Route::post('/admin/complaints/{id}/status', [ComplaintController::class, 'updateStatus'])->name('admin.update.status');
    Route::get('/profile', [AdminController::class, 'edit'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.password');
    Route::post(
        '/admin/complaints/{complaint}/assign-department',
        [ComplaintController::class, 'assignDepartment']
    )->name('admin.complaints.assign-department');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');

    // Cities
    Route::resource('cities', CityController::class);

    //feedback
    Route::get('/feedbacks', [ComplaintController::class, 'feedbackList'])->name('admin.feedbacks');

    // Admin Complaint Delete
    Route::delete('/admin/complaints/{id}', [ComplaintController::class, 'destroy'])
        ->name('admin.complaints.delete');

    // Admin message route — admin group ke andar
    Route::post('/admin/complaints/{complaintId}/messages', [MessageController::class, 'adminSend'])->name('messages.admin.send');


    Route::get('/departments', [DepartmentController::class, 'adminIndex'])->name('admin.departments');
    Route::post('/departments', [DepartmentController::class, 'adminStore'])->name('admin.departments.store');
    Route::delete('/departments/{id}', [DepartmentController::class, 'adminDestroy'])->name('admin.departments.destroy');
    Route::put('/departments/{id}', [DepartmentController::class, 'adminUpdate'])->name('admin.departments.update');
});


// ---- Department Routes ----

Route::prefix('department')->name('department.')->group(function () {

    // Guest routes (not logged in)
    Route::middleware('guest:department')->group(function () {
        Route::get('/login',  [DepartmentController::class, 'showLogin'])->name('login');
        Route::post('/login', [DepartmentController::class, 'login'])->name('login.post');
    });

    // Auth routes (logged in)
    Route::middleware('auth:department')->group(function () {
        Route::get('/dashboard', [DepartmentController::class, 'dashboard'])->name('dashboard');
        Route::post('/complaints/{complaint}/status', [DepartmentController::class, 'updateStatus'])->name('complaints.status');
        Route::get('/complaints/{complaint}', [DepartmentController::class, 'show'])->name('complaints.show');       // ADD
        Route::delete('/complaints/{complaint}', [DepartmentController::class, 'destroy'])->name('complaints.destroy'); // ADD
        Route::post('/logout', [DepartmentController::class, 'logout'])->name('logout');
    });
});


// AI Chatbot Route
Route::post('/chatbot', function (\Illuminate\Http\Request $request) {
    $request->validate(['messages' => 'required|array']);

    $systemInstruction = 'You are a helpful AI assistant for Smart Hyderabad City — a citizen complaint management system in Hyderabad, Pakistan.

Your job is to help citizens with:
1. How to register and submit complaints
2. Complaint categories: Water Supply, Electricity, Roads, Waste Management, Sewerage, Street Lights, Parks, Health, Traffic, Emergency
3. How to track complaint status (Pending → In Progress → Resolved)
4. How to download PDF of their complaint
5. How to rate and give feedback after resolution
6. General info about Smart Hyderabad City

Key Information:
- Register at: /register
- Login at: /login  
- After login go to Add Complaint to submit
- Fill: Title, Description, Category, Priority, City, Location
- Can attach photo and GPS location
- Complaint goes through: Submitted → Review → In Progress → Resolved
- User gets email notifications on status changes
- Can chat with admin directly on complaint page
- Can re-open complaint if not satisfied

Tone: Friendly, helpful. Mix Urdu and English naturally (Roman Urdu is fine).
Keep responses concise and clear. Use emojis to make it engaging.
Answer ALL questions helpfully. Never refuse a valid question.
If completely unrelated to city system, still try to help briefly then redirect.';

    // Clean aur proper format mein messages banao
    $cleanMessages = [];

    foreach ($request->messages as $msg) {
        $role = $msg['role'] === 'assistant' ? 'model' : 'user';
        $content = trim($msg['content']);

        if (!empty($content)) {
            $cleanMessages[] = [
                'role'  => $role,
                'parts' => [['text' => $content]]
            ];
        }
    }

    // Agar messages empty hain
    if (empty($cleanMessages)) {
        return response()->json([
            'content' => [['text' => 'Sawaal poochein, main madad karunga! 😊']]
        ]);
    }

    // Gemini API call
    $response = \Illuminate\Support\Facades\Http::timeout(30)->post(
        'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=' . env('GEMINI_API_KEY'),
        [
            'system_instruction' => [
                'parts' => [['text' => $systemInstruction]]
            ],
            'contents'         => $cleanMessages,
            'generationConfig' => [
                'temperature'     => 0.7,
                'maxOutputTokens' => 800,
                'topP'            => 0.95,
            ],
            'safetySettings' => [
                [
                    'category'  => 'HARM_CATEGORY_HARASSMENT',
                    'threshold' => 'BLOCK_NONE'
                ],
                [
                    'category'  => 'HARM_CATEGORY_HATE_SPEECH',
                    'threshold' => 'BLOCK_NONE'
                ],
                [
                    'category'  => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                    'threshold' => 'BLOCK_NONE'
                ],
                [
                    'category'  => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                    'threshold' => 'BLOCK_NONE'
                ],
            ]
        ]
    );

    $data = $response->json();

    // Debug — agar error aaye to log karo
    if (isset($data['error'])) {
        \Illuminate\Support\Facades\Log::error('Gemini API Error: ' . json_encode($data['error']));
        return response()->json([
            'content' => [['text' => 'API Error: ' . ($data['error']['message'] ?? 'Unknown error')]]
        ]);
    }

    if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        return response()->json([
            'content' => [[
                'text' => $data['candidates'][0]['content']['parts'][0]['text']
            ]]
        ]);
    }

    // Agar blocked ho
    if (isset($data['candidates'][0]['finishReason'])) {
        \Illuminate\Support\Facades\Log::warning('Gemini finish reason: ' . $data['candidates'][0]['finishReason']);
    }

    \Illuminate\Support\Facades\Log::error('Gemini unexpected response: ' . json_encode($data));

    return response()->json([
        'content' => [['text' => 'Thodi der baad dobara try karein! 🙏']]
    ]);
})->name('chatbot');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
