
<div class="container">
    <h1>Award Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Id: {{ $award_category->id }}</h5>
            <p class="card-text">Category Name: {{ $award_category->category_name }}</p>
        </div>
    </div>

</div>
@include('crud-js')