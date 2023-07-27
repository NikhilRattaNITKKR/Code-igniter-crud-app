<h2 class="mt-4 mb-4"> <?= $title ?></h2>

<?php foreach ($posts as $item) : ?>
    <h3> <?= $item['title'] ?> </h3>
    <small><?= 'Created at ' . $item['created_at'] ?></small>
    <p>
        <?= word_limiter($item['body'], 50) ?>
    </p>
    <a class="btn btn-primary" href="<?= site_url('/posts/' . $item['slug']) ?>"> Read more </a>

<?php endforeach ?>

<table id="myTable" class="display" width="100%">
    <!-- <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>slug</th>
                <th>Phone</th>
                <th>Post</th>
                <th>TimeStamp</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead> -->



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
                    title: 'Slug'
                },
                {
                    title: 'Body.'
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