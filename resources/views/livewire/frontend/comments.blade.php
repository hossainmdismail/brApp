<!--comment form-->
<div class="comment-form">
    <h4 class="mb-15">Add a review</h4>
    @if (session()->has('succ'))
        <div class="alert alert-success" role="alert">
            {{ session('succ') }}
        </div>
    @endif
    @if (session()->has('err'))
        <div class="alert alert-danger" role="alert">
            {{ session('err') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8 col-md-12">
            @if ($order)
                <form class="form-contact comment_form" wire:submit.prevent="save" id="commentForm">
                    <div class="row">
                        <div class="rating">
                            <input type="radio" id="star5" wire:model="rating" value="5" /><label
                                for="star5" title="5 stars"></label>
                            <input type="radio" id="star4" wire:model="rating" value="4" /><label
                                for="star4" title="4 stars"></label>
                            <input type="radio" id="star3" wire:model="rating" value="3" /><label
                                for="star3" title="3 stars"></label>
                            <input type="radio" id="star2" wire:model="rating" value="2" /><label
                                for="star2" title="2 stars"></label>
                            <input type="radio" id="star1" wire:model="rating" value="1" /><label
                                for="star1" title="1 star"></label>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100 @error('comment') is-invalid @enderror" wire:model="comment" id="comment"
                                    cols="30" rows="9" placeholder="Write Comment"></textarea>
                                @error('comment')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control @error('name') is-invalid @enderror" wire:model="name"
                                    id="name" type="text" placeholder="Name">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control @error('email') is-invalid @enderror" wire:model="email"
                                    id="email" type="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control @error('number') is-invalid @enderror" wire:model="number"
                                    id="website" type="number" placeholder="Number">
                                @error('number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button button-contactForm">Submit Review</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
