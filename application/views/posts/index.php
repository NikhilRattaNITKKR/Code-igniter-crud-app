<h2 class="mt-4 mb-4"> <?= $title ?></h2>



<table id="myTable" class="display " width="100%">
    
</table>

<script>
    <?php

    function addEditAndDeleteLinks($post)
    {
        $post['edit'] = "<a href='posts/edit/" . $post['slug'] . "' class='btn btn-primary me-4'>Edit</a>";
        $post['delete'] = "<a href='posts/delete/" . $post['id'] . "' class='btn btn-danger'>Delete</a>";
        return $post; // Return the modified post array
    }

    // Assuming $posts is the original array of posts
    $posts = array_map('addEditAndDeleteLinks', $posts);
    ?>

    var dataSet = <?= json_encode($posts) ?>

    $(document).ready(function() {
        dataSet.map((data, index) => {
            dataSet[index] = Object.values(data);
        });

        console.log(dataSet);

        $('#myTable').DataTable({
            columns: [{
                    title: 'Id'
                },
                {
                    title: 'Title'
                },
                {
                    title: 'Name'
                },
                {
                    title: 'Email'
                },
                {
                    title: 'Phone'
                },
                {
                    title: 'Slug'
                },
                {
                    title: 'Body'
                },
                {
                    title: 'Post_photo'
                },
                {
                    title: 'Created_at'
                },
                {
                    title: 'Edit'
                },
                {
                    title: 'Delete'
                },
            ],
            data: dataSet
        });
    });
</script>