@extends('dashboard.index')

@section('title', 'Add Menu')

@section('details')

<style type="text/css">
  .dark {
    background-color: #FFF;
    margin: 80px 20px 20px 30px;
    padding: 20px 20px 20px 20px;
  }
  .alert {
    color: #444444;
    height: 10px;
  }
</style>
<div class="content">
  <div class="col-sm-6 dark">
    <div class="alert" role="alert" id="prompt" hidden>
    </div>
    <fieldset>
      <legend>Add Menu Items</legend>

      <!-- Name of dish -->
      <div class="form-group">
        <label for="name" class = "control-label"> Name</label>
        <input type = "text" class = "form-control" id="name" placeholder="Name of the dish">
      </div>

      <!-- Dish category -->
      <div class="category">
        <label for="category" class="control-label"> Category</label>
        <select type="text" class="form-control" id="categories">
          @foreach ($categories as $category)
            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
          @endforeach
        </select>
      </div>

      <!--Description of the dish -->
      <div class="form-group">
        <label for="description" class="control-label"> Description</label>
        <textarea class="form-control" id="description" rows= "4" placeholder="e.g. Main ingredients and selling point"></textarea>
      </div>

      <!--price of the dish-->
      <div class="form-group">
        <label for="price" class="control-label"> Price</label>
        <input type="text" class="form-control" id="price" placeholder="Enter price">
      </div>

      <div class="form-group">
        <label for="tag" class="control-label"> Tags (Separate with comma)</label>
        <input type="text" class="form-control" id="tags" placeholder="Optional">
      </div>

      <!-- add button for appetizer field -->
      <button type="button" class="btn btn-primary" id="add"> Add</button>
    </fieldset>
  </div>
  <div class="col-sm-4 dark">
    <h4>Added Dishes</h4>
    <table class="table" id="added_items">
      
    </table>
    <p>Click to Finish Setup</p>
    <!--next button -->
    <form method="POST" id="next_link" action="{{ route('dashboard')}}">
      <input type="text" id="restaurant_id" value="{{ $restaurant_id }}" hidden>
      <button type="submit" class="btn btn-primary" id="next">Next</button>
    </form>
  </div>
</div>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript">
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' } });
</script>
<script type="text/javascript">var username = "{{ auth()->user()->username }}"; </script>>
<script type="text/javascript" src="/js/add-menus.js"></script>
@endsection