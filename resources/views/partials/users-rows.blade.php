@php($counter = 0)
@forelse($data as $row)
    @php($counter++)
    <tr>
        <td>{{ $counter }}</td>
        <td>{{ trim($row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name) }}</td>
        <td>{{ $row->email }}</td>
        <td>{{ $row->phone }}</td>
        <td>
            @if($row->role == 'admin')
                <span class="badge badge-primary bg-primary">Admin</span>
            @else
                <span class="badge badge-secondary bg-secondary">Editor</span>
            @endif
        </td>
        <td>
            @if($row->status == 'active')
                <span class="badge badge-success bg-success">Active</span>
            @else
                <span class="badge badge-danger bg-danger">Inactive</span>
            @endif
        </td>
        <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
        <td>{{ \App\Http\Controllers\v1\AdminController::getIssuedByUser($row->created_by) }}</td>
        <td style="white-space: nowrap;">
            @if($row->id == auth()->id())
                <em>You</em>
            @else
                <button type="button" class="btn btn-warning btn-sm" data-uuid="{{ $row->uuid }}" data-confirm="{{ $row->status == 'active' ? 'deactivate' : 'activate' }} this user" onclick="userAction(this, 'status')">
                    {{ $row->status == 'active' ? 'Deactivate' : 'Activate' }}
                </button>
                <button type="button" class="btn btn-info btn-sm" data-uuid="{{ $row->uuid }}" data-confirm="make this user {{ $row->role == 'admin' ? 'an editor' : 'an admin' }}" onclick="userAction(this, 'role')">
                    {{ $row->role == 'admin' ? 'Make Editor' : 'Make Admin' }}
                </button>
                <button type="button" class="btn btn-default btn-sm" data-uuid="{{ $row->uuid }}" data-email="{{ $row->email }}" onclick="openResetPassword(this)">
                    Reset Password
                </button>
            @endif
        </td>
    </tr>
@empty
    <tr><td colspan="9">No users found.</td></tr>
@endforelse
