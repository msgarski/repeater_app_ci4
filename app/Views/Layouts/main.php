<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation.min.css">
    <!-- Vue.js 3.0 (development build) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.0.11/vue.global.js"></script>
    
    <!-- <script src="https://unpkg.com/vue@next"></script> -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- <script src="./main.js"></script> -->

    <title><?= $this->renderSection("title") ?></title>
</head>
<body>

<div id="app">
</div>

    <?php if (session()->has('warning')): ?>
        <div class="warning">
            <?= session('warning') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('info')): ?>
        <div class="info">
            <?= session('info') ?>
        </div>
    <?php endif; ?>

    <?= $this->renderSection("content") ?>
    



    <script type="module">
    import app from './app.js'
    const {createApp} = Vue;
    createApp(app).mount('#app');
    </script>

</body>
<?= $this->renderSection("probaVue") ?>
</html>