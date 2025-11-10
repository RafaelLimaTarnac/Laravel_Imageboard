@php
use App\Models\User;
@endphp
<div class='post_preview'>
	<fieldset>
		<div class='post'>
			@if(!isset($no_reports) && Auth::check())
				@include('templates.create_report_form', ['id'=>$post->id, 'type'=>"post"])
			@endif

			@can('isAdmin')
			<div style="width: 110px;">
				<form method='POST' action='{{URL("posts/" . $post->id)}}'onclick='return confirm("Delete Post: {{$post->title}}\nAre you sure?")'>
				@csrf
				@method('DELETE')
					<input type='submit' value='Delete this Post' class='delete_button'>
				</form>
			</div>
			@endcan
			
			@if(count($post->files)>0)
				<span style='font-size: 0.8em;'>file: <a href='{{asset("storage/" . $post->files->first()->file_path)}}' target="_blank">{{substr($post->files->first()->file_path, 11)}}</a>
					({{$post->files->first()->name}})
				</span>
			@endif
			<div class='post_content'>
			@if(count($post->files)>0)
				@switch(pathinfo(asset("storage/" . $post->files->first()->file_path), PATHINFO_EXTENSION))
					@case('pdf')
						<img class='review_img' src='{{asset("images/pdf_icon.png")}}'></img>
					@break
					@default
						<img class='review_img' src='{{asset("storage/" . $post->files->first()->file_path)}}'></img>
				@endswitch
			<br>
			@endif
			<span style='white-space: nowrap;'>
				@if($post->status == 'pinned')
				<span style='color: red'>PINNED</span>
				@endif
				<span class='user_index'>{{User::findOrFail($post->id_user)->name}}</span>
				<span>{{$post->updated_at}}</span>
				<span class='title_index'><a href='{{URL("posts/" . $post->id)}}'>{{$post->title}}</a></span>
			</span>
			<br>
			@if(!isset($limit_content))
				<pre>{{$post->content}}</pre>
			@else
				@if(strlen($post->content) > $limit_content)
					<pre>{{substr($post->content, 0, $limit_content)}}</pre>
					<span>post is too long, click <a href='/posts/{{$post->id}}'>here</a> to see the full post</span>
				@else
					<pre>{{$post->content}}</pre>
				@endif
			@endif
			</div>
		</div>
		@if(count($post->comments)>0)
			@if(isset($limit))
				@for($i = count($post->comments) - $limit; $i <= count($post->comments) - 1; $i++)
					@if(isset($post->comments[$i]))
						@include('templates.comment', ['comment'=>$post->comments[$i]])
					@endif
				@endfor
			@else
				@foreach($post->comments as $comment)
					@include('templates.comment', ['comment'=>$comment])
				@endforeach
			@endif
		@endif
	</fieldset>
</div>