function markAsSolution(threadId, solutionId)
{
	var csrfToken='{{csrf_token()}}';

	$.post('{{route('markAsSolution')}}', {solutionId: solutionId, threadId: threadId, _token:csrfToken}, function(data){
	 	console.log(data);
	 });
}

        function markAsSolution(threadId, solutionId,elem) {
            var csrfToken='{{csrf_token()}}';
            $.post('{{route('markAsSolution')}}', {solutionId: solutionId, threadId: threadId,_token:csrfToken}, function (data) {
                $(elem).text('Solution');
            });
        }