@php
use App\Models\User;
@endphp
<div class='comment' id="{{$comment->id}}">
				@if(!isset($no_reports) && Auth::check())
					@include('templates.create_report_form', ['id'=>$comment->id, 'type'=>"comment"])
				@endif

				@can('isAdmin')
				<form method='POST' action='{{URL("comments/" . $comment->id)}}'>
				@csrf
				@method('DELETE')
					<input type='submit' value='Delete this Comment'>
				</form>
				@endcan

				@if(count($comment->files)>0)
					<span style='font-size: 0.8em;'>file: <a href='{{asset("storage/" . $comment->files->first()->file_path)}}' target="_blank">{{substr($comment->files->first()->file_path, 11)}}</a>
					</span>
				@endif
			<div class='comment_content'>
				@if(count($comment->files)>0)
					<img class='review_img' src='{{asset("storage/" . $comment->files->first()->file_path)}}'></img>
				@endif
				<div class='comment_info'>
					<span style='white-space: nowrap;'>
					 <span style='color: green'>{{User::findOrFail($comment->id_user)->name}}</span>
					 <span>{{$comment->created_at}} </span>
					 <span style='color: blue'>No. {{$comment->id}} |</span>
					@if(Auth::check())
					 <a href='{{URL( "posts/" . $comment->id_post . "/" . $comment->id)}}'><button>reply</button></a>
					@endif
					@if(count($comment->replies()->get()) > 0)
						@foreach($comment->replies()->get() as $reply)
							<a style='color: purple' href='{{URL( "posts/" . $comment->id_post . "#" . $reply->id)}}'>>>{{$reply->id}} </a>
						@endforeach
					@endif
					</span>
				</div>
				<blockquote>
					@if($comment->id_reply != null)
					<a class='reply' style="color: purple;" href='{{URL( "posts/" . $comment->id_post . "#" . $comment->id_reply)}}'>>>{{$comment->id_reply}}</a>
					@endif
					{{$comment->content}}
				</blockquote>
			</div>
</div>