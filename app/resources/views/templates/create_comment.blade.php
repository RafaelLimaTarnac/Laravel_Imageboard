@php
	use App\Models\Comment;
	if(isset($reply))
		$comment = Comment::findOrFail($reply);
@endphp


@if(isset($reply))
	<h2 style='color: red;text-align: center;'>reply mode</h2>
	@include('templates.comment', ['comment'=>$comment])
	 <a href='{{URL("posts/" . $comment->id_post)}}'><button>return</button></a>
@endif

<form method='POST' action='{{URL("/comments")}}' enctype='multipart/form-data' id='comment_form'>
@csrf
	<table>
		@if(isset($reply))
			<input type='hidden' name='id_reply' value='{{$reply}}'>
		@endif

		<input type='hidden' name='id_post' value='{{$post->id}}'>
		<tr>
			<th>Contents</th>
			<td><textarea name='content' maxlength="1000" required></textarea></td>
		</tr>
		<tr>
			<th>Attach Files</th>
			<td><input type='file' name='file'></td>
		</tr>
		<tr>
			<th colspan="2" class='submit_header'><input type='submit' value='Comment'></th>
		</tr>
	</table>
</form>