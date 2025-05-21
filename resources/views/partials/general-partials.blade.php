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
    @endif
@endif
