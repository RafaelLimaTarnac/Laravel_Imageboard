@php
use App\Models\User;
@endphp
<div class='comment' id="{{$comment->id}}">
				@if(!isset($no_reports) && Auth::check())
					@include('templates.create_report_form', ['id'=>$comment->id, 'type'=>"comment"])
				@endif

				@can('isAdmin')
				<form method='POST' action='{{URL("comments/" . $comment->id)}}' onclick='return confirm("Delete Comment id: {{$comment->id}}\nAre you sure?")'>
				@csrf
				@method('DELETE')
					<input type='submit' value='Delete this Comment' class='delete_button'>
				</form>
				@endcan

				@if(count($comment->files)>0)
					<span style='font-size: 0.8em;'>file: <a href='{{asset("storage/" . $comment->files->first()->file_path)}}' target="_blank">{{substr($comment->files->first()->file_path, 11)}}</a>
					({{$comment->files->first()->name}})
					</span>
				@endif
			<div class='comment_content'>
				@if(count($comment->files)>0)
					@include("templates.file_handler", ["path"=>$comment->files->first()->file_path])
				@endif
				<div class='comment_info'>
					<span style='white-space: nowrap;'>
					 <span class='user_index'>{{User::findOrFail($comment->id_user)->name}}</span>
					 <span>{{$comment->created_at}} </span>
					@if(Auth::check())
					 <span class='user_reply'><a href='{{URL( "posts/" . $comment->id_post . "/" . $comment->id)}}'>No. {{$comment->id}}</a></span>
					@else
					 <span>No. {{$comment->id}}</span>
					@endif
					@if(count($comment->replies()->get()) > 0)
						@foreach($comment->replies()->get() as $reply)
							<a style='color: purple' href='{{URL( "posts/" . $comment->id_post . "#" . $reply->id)}}'>>>{{$reply->id}} </a>
						@endforeach
					@endif
					</span>
				</div>
				<pre>
					@if($comment->id_reply != null)
					<a class='reply' style="color: purple;" href='{{URL( "posts/" . $comment->id_post . "#" . $comment->id_reply)}}'>>>{{$comment->id_reply}}</a>
					@endif
					{{$comment->content}}
				</pre>
			</div>
</div>