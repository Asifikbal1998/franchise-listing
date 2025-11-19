<?php
get_header();

// Franchise details
$franchise_name        = get_field('franchise_name');
$cash_required         = get_field('liquid_capital')         ?: '';
$franchise_fee         = get_field('franchise_fees')        ?: '';
$total_number_of_units = get_field('total_number_of_units') ?: 'N/A';
$franchising_since     = get_field('franchising_since')     ?: '';
$training_and_support  = get_field('training_and_support')  ?: 'Yes';
$financing_available   = get_field('financing_available')   ?: 'Yes';
$min_investment        = get_field('min_investment')        ?: '';
$max_investment        = get_field('max_investment')        ?: '';
$net_worth_required    = get_field('new_worth')    ?: '';

// Grab old values & errors from session
$old    = $_SESSION['form_old'] ?? [];
$errors = $_SESSION['form_errors'] ?? [];
$success = $_SESSION['form_success'] ?? '';

// Clear after fetch (so they don’t persist forever)
unset($_SESSION['form_old'], $_SESSION['form_errors'], $_SESSION['form_success']);
?>

<div class="container singel-franchise-page">
    <div class="row">
        <!-- Left Content -->
        <div class="col-lg-8">
            <!-- Title -->
            <h2 class="mb-3"><?php echo esc_html($franchise_name) ?></h2>
            <div class="main-content-body">
                <?php the_content(); ?>
            </div>

            <!-- Example card section (unchanged) -->
            <div class="container my-5">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-5 d-flex align-items-center justify-content-between">
                        <div class="text-center text-md-start">
                            <h3 class="fw-bold text-primary mb-3">
                                What Does an Automated Investment Opportunity Cost?
                            </h3>
                            <p class="mb-0">
                                Interested parties should have at least
                                <span class="fw-bold text-dark">$<?php echo number_format($cash_required); ?></span>
                                in liquid capital to invest.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More highlights... (unchanged) -->
            <!-- Highlights -->
            <h4 class="mt-5 mb-3">Highlights</h4>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Cash Required</h6>
                        <?php if ($cash_required) { ?>
                            <p class="fs-5 fw-bold">$<?php echo number_format($cash_required); ?></p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">-</p>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Min. Franchise Fee</h6>
                        <?php if ($franchise_fee) { ?>
                            <p class="fs-5 fw-bold">$<?php echo number_format($franchise_fee); ?></p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">-</p>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Total Number of Units</h6>
                        <?php if ($total_number_of_units) { ?>
                            <p class="fs-5 fw-bold"><?php echo number_format($total_number_of_units); ?></p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">-</p>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Franchising Since</h6>
                        <?php if ($franchising_since) { ?>
                            <p class="fs-5 fw-bold"><?php echo $franchising_since; ?></p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">-</p>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Training and Support</h6>
                        <?php if ($training_and_support === 'Yes') { ?>
                            <p class="fs-5 fw-bold">Yes</p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">No</p>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Financing Available</h6>
                        <?php if ($financing_available === 'Yes') { ?>
                            <p class="fs-5 fw-bold">Yes</p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">No</p>
                        <?php }  ?>
                    </div>
                </div>
            </div>

            <!-- Investment -->
            <h4 class="mt-5 mb-3">Starting Costs & Investment Requirements</h4>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Total Investment</h6>
                        <?php if ($min_investment > 0 || $max_investment > 0) { ?>
                            <p class="fs-5 fw-bold">$<?php echo number_format($min_investment); ?> – $<?php echo number_format($max_investment); ?></p>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Net Worth Required</h6>
                        <?php if ($net_worth_required) { ?>
                            <p class="fs-5 fw-bold">$<?php echo number_format($net_worth_required); ?></p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">-</p>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3 h-100">
                        <h6 class="text-muted">Cash Required</h6>
                        <?php if ($cash_required) { ?>
                            <p class="fs-5 fw-bold">$<?php echo number_format($cash_required); ?></p>
                        <?php } else { ?>
                            <p class="fs-5 fw-bold">-</p>
                        <?php }  ?>
                    </div>
                </div>
            </div>

            <!-- Candidate -->
            <h4 class="mt-5">Ideal Candidate</h4>
            <p>The ideal franchise owner is someone driven by the desire to build their own successful business while leveraging the strength of an established brand. You don’t need prior industry experience — what matters most is your entrepreneurial mindset, leadership ability, and willingness to follow a proven system. If you are passionate about customer service, eager to grow, and ready to take control of your financial future, you could be the perfect fit for <strong><?php echo $franchise_name; ?></strong>.</p>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3">Franchise Request List</h5>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $err): ?>
                                <li>❌ <?php echo esc_html($err); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        ✅ <?php echo esc_html($success); ?>
                    </div>
                <?php endif; ?>

                <form id="franchiseForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <?php wp_nonce_field('franchise_form_action', 'franchise_form_nonce'); ?>
                    <input type="hidden" name="action" value="submit_franchise_form">

                    <div style="display:none;">
                        <input type="text" name="user_name" value="">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="firstname" class="form-control" placeholder="First Name" required
                            value="<?php echo esc_attr($old['firstname'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name" required
                            value="<?php echo esc_attr($old['lastname'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required
                            value="<?php echo esc_attr($old['email'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <input type="tel" name="phonenumber" class="form-control" placeholder="Phone Number" required
                            value="<?php echo esc_attr($old['phonenumber'] ?? $old['phone'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="zipcode" class="form-control" placeholder="Zip Code" required
                            value="<?php echo esc_attr($old['zipcode'] ?? ''); ?>">
                    </div>

                    <input type="hidden" name="franchisename" value="<?php echo esc_attr($old['franchisename'] ?? $franchise_name ?? ''); ?>">

                    <div class="mb-3">
                        <select class="form-select" name="availablecapital" required>
                            <option value="">Available Capital</option>
                            <option value="10000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '10000', false); ?>>Less Than $10,000</option>
                            <option value="20000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '20000', false); ?>>Less Than $20,000</option>
                            <option value="30000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '30000', false); ?>>Less Than $30,000</option>
                            <option value="40000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '40000', false); ?>>Less Than $40,000</option>
                            <option value="50000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '50000', false); ?>>Less Than $50,000</option>
                            <option value="60000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '60000', false); ?>>Less Than $60,000</option>
                            <option value="70000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '70000', false); ?>>Less Than $70,000</option>
                            <option value="80000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '80000', false); ?>>Less Than $80,000</option>
                            <option value="90000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '90000', false); ?>>Less Than $90,000</option>
                            <option value="100000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '100000', false); ?>>Less Than $100,000</option>
                            <option value="150000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '150000', false); ?>>Less Than $150,000</option>
                            <option value="200000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '200000', false); ?>>Less Than $200,000</option>
                            <option value="250000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '250000', false); ?>>Less Than $250,000</option>
                            <option value="300000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '300000', false); ?>>Less Than $300,000</option>
                            <option value="400000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '400000', false); ?>>Less Than $400,000</option>
                            <option value="450000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '450000', false); ?>>Less Than $450,000</option>
                            <option value="500000" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '500000', false); ?>>Less Than $500,000</option>
                            <option value="500001" <?php echo selected($old['availablecapital'] ?? $old['capital'] ?? '', '500001', false); ?>>$500,000+</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" name="timeframe" required>
                            <option value="">Timeframe to Invest</option>
                            <option value="Immediately" <?php echo selected($old['timeframe'] ?? '', 'Immediately', false); ?>>Immediately</option>
                            <option value="3–6 Months" <?php echo selected($old['timeframe'] ?? '', '3–6 Months', false); ?>>3–6 Months</option>
                            <option value="6–12 Months" <?php echo selected($old['timeframe'] ?? '', '6–12 Months', false); ?>>6–12 Months</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" name="desiredlocation" required>
                            <option value="">Desired Location</option>
                            <option value="Alabama" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Alabama', false); ?>>Alabama</option>
                            <option value="Alaska" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Alaska', false); ?>>Alaska</option>
                            <option value="Arizona" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Arizona', false); ?>>Arizona</option>
                            <option value="Arkansas" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Arkansas', false); ?>>Arkansas</option>
                            <option value="California" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'California', false); ?>>California</option>
                            <option value="Colorado" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Colorado', false); ?>>Colorado</option>
                            <option value="Connecticut" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Connecticut', false); ?>>Connecticut</option>
                            <option value="Delaware" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Delaware', false); ?>>Delaware</option>
                            <option value="Florida" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Florida', false); ?>>Florida</option>
                            <option value="Georgia" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Georgia', false); ?>>Georgia</option>
                            <option value="Hawaii" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Hawaii', false); ?>>Hawaii</option>
                            <option value="Idaho" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Idaho', false); ?>>Idaho</option>
                            <option value="Illinois" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Illinois', false); ?>>Illinois</option>
                            <option value="Indiana" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Indiana', false); ?>>Indiana</option>
                            <option value="Iowa" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Iowa', false); ?>>Iowa</option>
                            <option value="Kansas" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Kansas', false); ?>>Kansas</option>
                            <option value="Kentucky" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Kentucky', false); ?>>Kentucky</option>
                            <option value="Louisiana" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Louisiana', false); ?>>Louisiana</option>
                            <option value="Maine" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Maine', false); ?>>Maine</option>
                            <option value="Maryland" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Maryland', false); ?>>Maryland</option>
                            <option value="Massachusetts" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Massachusetts', false); ?>>Massachusetts</option>
                            <option value="Michigan" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Michigan', false); ?>>Michigan</option>
                            <option value="Minnesota" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Minnesota', false); ?>>Minneseta</option>
                            <option value="Mississippi" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Mississippi', false); ?>>Mississippi</option>
                            <option value="Missouri" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Missouri', false); ?>>Missouri</option>
                            <option value="Montana" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Montana', false); ?>>Montana</option>
                            <option value="Nebraska" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Nebraska', false); ?>>Nebraska</option>
                            <option value="Nevada" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Nevada', false); ?>>Nevada</option>
                            <option value="New Hampshire" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'New Hampshire', false); ?>>New Hampshire</option>
                            <option value="New Jersey" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'New Jersey', false); ?>>New Jersey</option>
                            <option value="New Mexico" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'New Mexico', false); ?>>New Mexico</option>
                            <option value="New York" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'New York', false); ?>>New York</option>
                            <option value="North Carolina" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'North Carolina', false); ?>>North Carolina</option>
                            <option value="North Dakota" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'North Dakota', false); ?>>North Dakota</option>
                            <option value="Ohio" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Ohio', false); ?>>Ohio</option>
                            <option value="Oklahoma" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Oklahoma', false); ?>>Oklahoma</option>
                            <option value="Oregon" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Oregon', false); ?>>Oregon</option>
                            <option value="Pennsylvania" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Pennsylvania', false); ?>>Pennsylvania</option>
                            <option value="Rhode Island" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Rhode Island', false); ?>>Rhode Island</option>
                            <option value="South Carolina" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'South Carolina', false); ?>>South Carolina</option>
                            <option value="South Dakota" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'South Dakota', false); ?>>South Dakota</option>
                            <option value="Tennessee" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Tennessee', false); ?>>Tennessee</option>
                            <option value="Texas" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Texas', false); ?>>Texas</option>
                            <option value="Utah" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Utah', false); ?>>Utah</option>
                            <option value="Vermont" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Vermont', false); ?>>Vermont</option>
                            <option value="Virginia" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Virginia', false); ?>>Virginia</option>
                            <option value="Washington" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Washington', false); ?>>Washington</option>
                            <option value="West Virginia" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'West Virginia', false); ?>>West Virginia</option>
                            <option value="Wisconsin" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Wisconsin', false); ?>>Wisconsin</option>
                            <option value="Wyoming" <?php echo selected($old['desiredlocation'] ?? $old['location'] ?? '', 'Wyoming', false); ?>>Wyoming</option>
                        </select>
                    </div>
                    <!-- Add inside your <form> -->
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                    <script src="https://www.google.com/recaptcha/api.js?render=6LeAJrcrAAAAAP15Oecym3thZmUF7Pvk3RkWD8GB"></script>
                    <script>
                        grecaptcha.ready(function() {
                            grecaptcha.execute("6LeAJrcrAAAAAP15Oecym3thZmUF7Pvk3RkWD8GB", {
                                action: "submit"
                            }).then(function(token) {
                                document.getElementById("g-recaptcha-response").value = token;
                            });
                        });
                    </script>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Request Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>