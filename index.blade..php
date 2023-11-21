php artisan make:migration create_inboxes_table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboxesTable extends Migration
{
    public function up()
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->longText('message');
            $table->timestamps();
            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inboxes');
    }
}
php artisan migrate
use App\Http\Controllers\InboxController;

Route::get('/inboxes', [InboxController::class, 'index']);
Route::get('/inboxes/{inbox}', [InboxController::class, 'show']);
php artisan make:controller InboxController
use App\Models\Inbox;

public function index()
{
    $inboxes = Inbox::paginate(15);
    return view('inboxes.index', compact('inboxes'));
}

public function show(Inbox $inbox)
{
    return view('inboxes.show', compact('inbox'));
}
@foreach ($inboxes as $inbox)
    <tr>
        <td>{{ $inbox->id }}</td>
        <td>{{ $inbox->name }}</td>
        <td>{{ $inbox->phone }}</td>
        <td>{{ $inbox->message }}</td>
        <td>{{ $inbox->created_at }}</td>
        <td>{{ $inbox->updated_at }}</td>
    </tr>
@endforeach
