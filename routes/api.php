<?

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/floors', [LocationController::class, 'api_floors']);

require __DIR__.'/auth.php';