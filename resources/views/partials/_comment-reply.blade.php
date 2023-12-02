<div class="p-3 shadow mb-5">
    <h5 class=" text-primary">Share Your thoughts about the product <i class="bi bi-chat-text-fill"></i> </h5>
    <hr>
    <form method="POST" action="{{ route('comment.store', $product) }}" class="text-end p-4">
        @csrf
        <textarea name="comment" id="" class="form-control" placeholder="Write something..." rows="4">
            {{old('comment')}}
        </textarea>
        @error('comment')
            <p class="text-start fw-semibold text-danger"> {{ $message }} </p>
        @enderror
        <button class="btn btn-primary mt-2">Comment</button>
    </form>
    <h5 class="text-primary">All the commets here</h5>
    <hr>

    <!-- comments here -->
    @forelse($comments as $comment)
        <div class="mb-4 comment-div">
            <h6 class="fw-bolder mb-0"> <i class="bi bi-person-circle"></i> {{ $comment->user->name }} </h6>
            <p class="small text-secondary mb-0"> {{ $comment->created_at->diffForHumans() }} </p>
            <p class="fw-thin mb-0"> {{ $comment->comment }} </p>
            <a href="javascript:void(0)" class="small text-decoration-none text-success fw-semibold "
                onclick="reply(this)" data-commentId="{{ $comment->id }}">Reply</a>

            <!-- replies -->
            @foreach ($replies as $reply)
                @if ($comment->id === $reply->parent_id)
                    <div class="ms-3 mt-2 mb-4 pb-3 p-3 shadow">
                        <h6 class="fw-bolder mb-0">
                            <i class="bi bi-person-circle"></i> {{ $reply->user->name }} <i
                                class="bi bi-heart-arrow"></i> <span
                                class="text-secondary small">{{ $comment->user->name }}</span>
                        </h6>
                        <p class="small text-secondary mb-0"> {{ $reply->created_at->diffForHumans() }} </p>
                        <p class="fw-thin mb-0"> {{ $reply->reply }} </p>
                        <a href="javascript:void(0)" onclick="reply(this)" data-commentId="{{ $reply->id }}"
                            class="small text-decoration-none text-success fw-semibold ">Reply</a>
                    </div>

                    <!--nested replies -->
                    @foreach ($cReplies as $cReply)
                        @if ($reply->id == $cReply->parent_id)
                        <div class="ms-5 mt-2 mb-4 pb-3 p-3 shadow">
                            <h6 class="fw-bolder mb-0">
                                <i class="bi bi-person-circle"></i> {{ $cReply->user->name }} <i
                                    class="bi bi-heart-arrow"></i> <span
                                    class="text-secondary small">{{ $reply->user->name }}</span>
                            </h6>
                            <p class="small text-secondary mb-0"> {{ $cReply->created_at->diffForHumans() }} </p>
                            <p class="fw-thin mb-0"> {{ $cReply->reply }} </p>
                        </div>
                        @endif
                    @endforeach

                @endif
            @endforeach
        </div>
    @empty
        <p class="text-center fw-bold text-danger"> No Comments Yet! </p>
    @endforelse




    <div id="replyDiv" class="text-end p-4 border rounded mb-5" style="display: none">
        <form method="POST" action="{{ route('reply.store') }}"id="replyForm">
            @csrf
            <input type="hidden" id="commentId" name="parent_id">
            <div class="mb-3">
                <textarea name="reply" id="" class="form-control" rows="3"></textarea>
            </div>
        </form>
        <div>
            <button class="btn btn-danger" onclick="cancelReply(self)">Cancel</button>
            <button class="btn btn-primary" onclick="submit(this)">Reply</button>
        </div>
    </div>
</div>


<script>
    function reply(self) {
        $('#commentId').val($(self).attr('data-commentId'))

        $('#replyDiv').insertAfter($(self))
        $('#replyDiv').toggle()
    }

    function cancelReply(self) {
        $('#replyDiv').hide()
    }

    function submit(self) {
        $('#replyForm').submit();
    }
</script>
