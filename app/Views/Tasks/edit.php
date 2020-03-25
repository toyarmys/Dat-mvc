<h1>Edit task</h1>
<form method='post' action='#'>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter a title" 
        name="title" value ="<?php if ($task->getTitle()) {echo $task->getTitle();}?>">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" placeholder="Enter a description" 
        name="description" value ="<?php if ($task->getDescription()) {echo $task->getDescription();}?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>