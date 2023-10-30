<?php $this->layout('template', ['title' => $title]) ?>
<h2><?= $title; ?> - TESTE</h2>


<?php $this->start('scripts') ?>
<script>
    axios.defaults.headers = {
        "Content-Type": "application/json",
        X_REQUESTED_WITH: "XMLHttpRequest",
    };

    async function loadUsers() {
        try {
            const {data} = await axios.get('/api/users');
            console.log(data);
        } catch (error) {
            console.log(error);
        }
    }
    loadUsers();
</script>
<?php $this->stop() ?>