<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Widok lekcji<?= $this->endsection() ?>



<?= $this->section('content') ?>

<h1>Widok lekcji</h1>



<button><a href=" <?= site_url('/login/exiting')  ?>">Wyloguj</a></button>

<button><a href=" <?= site_url('/cards/index/').$lessonInfo->id."/".$amount = 2  ?>">Dodaj wiele kart</a></button>

<button><a href=" <?= site_url('/cards/index/').$lessonInfo->id."/".$amount = 1 ?>">Dodaj karty pojedynczo</a></button>


<div>
    <label for="tryouts">Oczekujące testy:</label>
</div>

<div>
    <label for="repetitions">Powtórki na dziś:</label>
</div>

<p>Twoje karty w tej lekcji:</p>

<div>
    <a href="<?=  site_url('/course/getInsideCourse/').$lessonInfo->course_id ?>">Powrót do kursu</a>
</div>

<div id="proba">
    <?php if(session()->has('user_id')): ?>
        <p>Jesteś zalogowany</p>
    <?php else: ?>
        <P>Wylogowano</P>
    <?php endif; ?>

    <p>Counter: {{ counter }}</p>
</div>
<div id="proba2">
    <div class="columns medium-4" v-for="(result, index) in results">
        <div class="card">
        <div class="card-section">
            <p> {{ index }} </p>
        </div>
        <div class="card-divider">
            <p>$ {{ result.USD }}</p>
        </div>
        <div class="card-section">
            <p> &#8364 {{ result.EUR }}</p>
        </div>
        </div>
    </div>
    <div>
        <button v-on:click="funkcja">Odśwież</button>
    </div>
</div>

<div id="proba3">
        <div>
            <p>{{ wynik }}</p>
            <button v-on:click="funkcja">Wynik</button>
        </div>


</div>


<?= $this->endsection() ?>




<?= $this->section('probaVue') ?>

    <script>
    const Counter = {
        data() {
        return {
            counter: 0
        }
        },
        mounted() {
        setInterval(() => {
        this.counter++
        }, 1000)
    }
    }
    Vue.createApp(Counter).mount('#proba')
    </script>

    <script>
    const url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH&tsyms=USD,EUR";
    const vm = {
        data() {
            return {
                results: []
            }
        },
        mounted() {
            axios.get(url).then(response => {
            this.results = response.data
          })
        },
        methods: {
            funkcja() {
            axios.get(url).then(response => {
            this.results = response.data})
            }
        }
      }
      Vue.createApp(vm).mount('#proba2')
    
    </script>













<script>
    const url2 = "<?= site_url('/course/proba') ?>";
    const vm2 = {
        data() {
            return {
                wynik: 'nikt'
            }
        },
        
        methods: {
            funkcja() {
            axios.get(url2)
            // .then(response => {
            // this.wynik = response.data.score})
            .then(response => {console.log(response.data.score)})
            .catch(error => {

            });
            }
        }
      }
      Vue.createApp(vm2).mount('#proba3')
    </script>


















<?= $this->endsection() ?>
