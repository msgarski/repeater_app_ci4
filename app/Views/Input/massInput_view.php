<?= $this->extend("layouts/main") ?>

<?= $this->section("title") ?>Wprowadzanie kart<?= $this->endsection() ?>

<?= $this->section("content") ?>


<h1>Wprowadzanie wielu kart</h1>
<p>Wprowadź listę słów:</p>
<?= form_open("/cards/createManyCards") ?>
<div>
    <label for="cardsInput"></label>
    <textarea rows="10" cols="100" name="cardsInput" id="cardsInput" 
    placeholder="<?= $placeholder ?>"></textarea>
</div>

<div>
    <label for="reckon">wykrywaj znaki rozdzielające</label>
    <input type="checkbox" name="reckon" id="reckon" checked>
</div>

<div>
        <input type="hidden" name="lesson_id" id="lesson_id" value="<?= $lesson_id ?>">
</div>

<button>Zapisz</button>

</form>






<?= $this->endsection() ?>
