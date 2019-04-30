
    <form action='<?= BASE_DIR ?>/reviewedit/<?=$locals['product_id']?>' method='post'>
        <label>Review Title</label><br>
        <input name="review_title" required type="text" size="100"/>
        <br>
        <label>Review</label><br>
        <textarea type="text" name="review_text" rows="10" cols="100"></textarea>
        <br>
        <label>Rating</label><br>
        <input name="suggest" type="radio" value=true checked/>Good<br>
        <input name="suggest" type="radio" value=false/>Bad<br>
        <br>
        <input id="submitButton" type="submit" value="Submit" />
    </form>
