@php
use App\Models\User;
@endphp
<div class='comment'>
				
				@if(!isset($no_reports))
					@include('templates.create_report_form', ['id'=>$comment->id, 'type'=>"comment"])
				@endif

				@can('isAdmin')
				<form method='POST' action='{{URL("comments/" . $comment->id)}}'>
				@csrf
				@method('DELETE')
					<input type='submit' value='Delete this Comment'>
				</form>
				@endcan

				<div class='comment_info'>
				 <span style='color: blue'>>>{{$comment->id}} |</span>
				 <span>{{$comment->created_at}} </span>
				 <span style='color: green'>{{User::findOrFail($comment->id_user)->name}}</span>
				 <a href='{{URL( "posts/" . $comment->id_post . "/" . $comment->id)}}'><button>reply</button></a>
				@if(count($comment->replies()->get()) > 0)
					@foreach($comment->replies()->get() as $reply)
						<span style='color: purple'>>>{{$reply->id}} </span>
					@endforeach
				@endif
				</div>

			<div class='comment_content'>
				@if(count($comment->files)>0)
					<img class='comment_index_img' src='{{asset("storage/" . $comment->files->first()->file_path)}}'></img>
				@endif
				<blockquote>
					@if($comment->id_reply != null)
					<span class='reply' style="color: purple;">>>{{$comment->id_reply}}</span>
					@endif
					{{$comment->content}}
				</blockquote>
			</div>
</div>