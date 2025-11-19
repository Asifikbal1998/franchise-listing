<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('submit_franchise_nonce_action', 'submit_franchise_nonce'); ?>

    <div class="form-group">
        <label>Franchise/Brands Name <span>*</span></label>
        <input type="text" name="franchise_name" required>
    </div>

    <div class="form-group">
        <label>Description <span>*</span></label>
        <?php
        wp_editor('', 'franchise_description', [
            'textarea_name' => 'franchise_description',
            'media_buttons' => false,
            'textarea_rows' => 6,
            'teeny' => true,
        ]);
        ?>
    </div>

    <div class="form-group">
        <label>Franchise/Brands Category <span>*</span></label>
        <input type="text" name="franchise_category" required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Cash Required (USD) <span>*</span></label>
            <input type="number" name="cash_required" required>
        </div>
        <div class="form-group">
            <label>Min Investment (USD) <span>*</span></label>
            <input type="number" name="min_investment" required>
        </div>
        <div class="form-group">
            <label>Max Investment (USD) <span>*</span></label>
            <input type="number" name="max_investment" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Net Worth Required (USD) <span>*</span></label>
            <input type="number" name="net_worth_required" required>
        </div>
        <div class="form-group">
            <label>Franchise Fees (USD) <span>*</span></label>
            <input type="number" name="franchise_fees" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Total Number of Units</label>
            <input type="text" name="total_number_of_units">
        </div>
        <div class="form-group">
            <label>Franchising Since</label>
            <input type="text" name="franchising_since">
        </div>
    </div>

    <div class="form-group">
        <label>Corporate Headquarters</label>
        <input type="text" name="corporate_headquarters">
    </div>

    <div class="form-group">
        <label>CEO Name</label>
        <input type="text" name="ceo_name">
    </div>

    <div class="form-group">
        <label>Training and Support</label>
        <select name="training_and_support">
            <option value="">-- Select --</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
    </div>

    <div class="form-group">
        <label>Financing Available</label>
        <select name="financing_available">
            <option value="">-- Select --</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
    </div>

    <div class="form-group">
        <label>Website URL</label>
        <input type="url" name="franchise_website">
    </div>

    <div class="form-group">
        <label>Upload Logo</label>
        <input type="file" name="franchise_logo" accept="image/<span>*</span>">
    </div>

    <input type="submit" name="submit_franchise_form" value="Submit Franchise" class="submit-button">
</form>