@if(isset($data) && isset($section))
    @if($section == 'top_navbar')

        @if(count($data) >0)
            @php($counter = 0)
            @foreach($data as $row)
                @php($counter++)
                <tr>
                    <td>{{$counter}}</td>
                    <td>{{strtoupper(strtolower($row->position))}}</td>
                    @if($row->position != 'center')
                        <td><img src="{{asset('storage/'.$row->data)}}" alt="logo" style="width:45px;"></td>
                    @else
                        <td>{{$row->data}}</td>
                    @endif
                    <td><span class="badge text-bg-success">{{ucwords($row->status)}}</span></td>
                    <td>{{date('d-m-Y',strtotime($row->created_at))}}</td>
                    <td>{{ \App\Http\Controllers\v1\AdminController::getIssuedByUser($row->created_by) }}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" id="remove-top-navbar-data-link" onclick="processLink(this)" data-topnavid="{{$row->uuid}}">Remove</button></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">No any data found.</td>
            </tr>
        @endif
    @elseif($section == 'slider_navbar')

        @if(count($data) >0)
            @php($counter = 0)
            @foreach($data as $row)
                @php($counter++)
                <tr>
                    <td>{{$counter}}</td>
                    <td>{{strtoupper(strtolower($row->position))}}</td>
                    <td><img src="{{asset('storage/'.$row->value)}}" alt="logo" style="width:45px;"></td>
                    <td>{{$row->title}}</td>
                    <td>{{$row->name}}</td>
                    <td><span class="badge text-bg-success">{{ucwords($row->status)}}</span></td>
                    <td>{{date('d-m-Y',strtotime($row->created_at))}}</td>
                    <td>{{ \App\Http\Controllers\v1\AdminController::getIssuedByUser($row->created_by) }}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" id="remove-slider-data-link" onclick="processLink(this)" data-sliderid="{{$row->uuid}}">Remove</button></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">No any data found.</td>
            </tr>
        @endif
    @elseif($section == 'content_section')
        @if(count($data) >0)
            @php($counter = 0)
            @foreach($data as $row)
                @php($counter++)
                @php($imageData = \App\Http\Controllers\v1\AdminController::getContentImage($row->id))
                <tr>
                    <td>{{$counter}}</td>
                    @if($imageData && $imageData->document_type == 'image')
                        <td><img src="{{asset('storage/'.$imageData->document_path)}}" alt="img" width="100"></td>
                    @else
                        <td>Not Image</td>
                    @endif
                    <td>{{strtoupper(strtolower($row->category))}}</td>
                    <td>{{$row->title}}</td>
                    <td>{{$row->short_description}}</td>
                    <td>{{$row->body}}</td>
                    <td>{{date('d-m-Y',strtotime($row->published_at))}}</td>
                    <td>{{$row->status}}</td>
                    <td>{{ \App\Http\Controllers\v1\AdminController::getIssuedByUser($row->created_by) }}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" id="remove-content-section-data-link" onclick="processLink(this)" data-contentdata="{{$row->uuid}}">Remove</button></td>
                </tr>
            @endforeach
        @endif
    @elseif($section == 'contact_us')
        @if(count($data) >0)
            @php($counter = 0)
            @foreach($data as $row)
                @php($counter++)
                <tr>
                    <td>{{$counter}}</td>
                    <td>{{ucwords(strtolower($row->first_name))}}</td>
                    <td>{{ucwords(strtolower($row->last_name))}}</td>
                    <td>{{strtolower($row->email)}}</td>
                    <td>{{ucwords($row->subject)}}</td>
                    <td>{{$row->status}}</td>
                    @if($row->read == 'seen')
                        <td><span class="badge badge-success bg-success">Attended</span></td>
                    @else
                        <td><span class="badge badge-danger bg-danger">Un Attended</span></td>
                    @endif

                    <td>{{date('d-m-Y h:i', strtotime($row->created_at))}}</td>
                    <td>{{ \App\Http\Controllers\v1\AdminController::getIssuedByUser($row->seen_by) }}</td>
                    <td>
                        @if($row->seen_at != '')
                            {{date('d-m-Y', strtotime($row->seen_at))}}
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" id="read-content-section-data-link" data-toggle="modal" data-target="#read-user-feedback-modal" onclick="processLink(this)" data-readata="{{$row->uuid}}">Read <i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" id="remove-feedback-section-data-link" onclick="processLink(this)" data-contentdata="{{$row->uuid}}">Remove</button>
                    </td>
                </tr>
            @endforeach
        @endif
    @elseif($section == 'read_feedback_section')
        @if(count($data) >0)
            <h5>From: {{$data->first()->email}}</h5>
            <p>Message:</p>
            <p>{{$data->first()->message}}</p>
        @endif
    @endif
@endif
