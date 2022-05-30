<div class="container">
    <h1 class="py-2">Your Job Posts</h2>
        <?php
        $records = count($this->result['data'][0]); //number of job posts
        $data = $this->result['data'];
        for ($i = 0; $i < $records; $i++) {
            echo '
            <a href="/recruit/getId/' . $data[0][$i] . '">
            <h1>' . $data[2][$i] . '</h1>
            <h2>Title: ' . $data[3][$i] . '</h2>
            <h2>Required ' . $data[4][$i] . ' year(s) of experience</h2>
            </a>
            ';
        }
        ?>
        <a href="/recruit/create" class="btn btn-primary">Create Post</a>
</div>