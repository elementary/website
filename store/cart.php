<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Cart &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store.css">';
    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/../backend/store.php';
    $cart = store_cart();

    if ($cart) {

?>

<script>
    jQl.loadjQdep('scripts/store/cart.js');
</script>

<form action="/store/checkout" method="post">
    <div class="row">
        <h1>Cart</h1>

        <?php
            $sub_total = 0;
            $index = 0;
            foreach ($cart as $id => $product) {
                $sub_total += ($product['quantity'] * $product['retail_price']);
                $index++;
        ?>

        <div class="row product">
            <img src="images/store/<?php echo $product['uid'] ?>-small.png"/>
            <div class="information">
                <h3><?php echo $product['full_name'] ?></h3>
                <h3>$<?php echo $product['retail_price'] ?></h3>
            </div>
            <div>
                <input type="hidden" name="product-<?php echo $index ?>-id" value="<?php echo $id ?>">
                <input type="hidden" name="product-<?php echo $index ?>-price" value="<?php echo $product['retail_price'] ?>">
                <label for="product-<?php echo $index ?>-quantity">Qty:</label>
                <input type="number" min="0" max="<?php echo $product['inventory']['quantity_available'] ?>" step="1" value="<?php echo $product['quantity'] ?>" name="product-<?php echo $index ?>-quantity">
            </div>
            <a href="/store/inventory?id=<?php echo $product['id'] ?>&math=subtract&quantity=<?php echo $product['quantity'] ?>">remove</a>
        </div>

        <?php
            }
        ?>

        <div class="row">
            <hr>
            <h4 class="totals">Sub-Total: $<?php echo $sub_total ?></h4>
        </div>


    </div>

    <div class="row" >
        <h2>Shipping information</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="John Smith" autocomplete="name" required>
        </div>

        <div>
            <label for="address-line1">Address</label>
            <input type="text" name="address-line1" placeholder="110 Southwark Street" autocomplete="address-line1" required>
            <input type="text" name="address-line2" placeholder="Room 32" autocomplete="address-line2">
        </div>

        <div>
            <label for="address-level2">City</label>
            <input type="text" name="address-level2" placeholder="Mountain View" autocomplete="address-level2" required>

            <label for="address-level1">State / Province / Region</label>
            <input type="text" name="address-level1" placeholder="CA" autocomplete="address-level1" required>
        </div>

        <div>
            <label for="postal-code">Postal Code</label>
            <input type="text" name="postal-code" placeholder="85085" autocomplete="postal-code" required>

            <label for="country">Country</label>
            <select name="country" autocomplete="country">
                <!--
                <option value="AF">Afghanistan</option>
                <option value="AX">Aland Islands</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AS">American Samoa</option>
                <option value="AD">Andorra</option>
                <option value="AO">Angola</option>
                <option value="AI">Anguilla</option>
                <option value="AG">Antigua &amp; Barbuda</option>
                <option value="AR">Argentina</option>
                <option value="AM">Armenia</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="AZ">Azerbaijan</option>
                <option value="A2">Azores</option>
                <option value="BS">Bahamas</option>
                <option value="BH">Bahrain</option>
                <option value="BD">Bangladesh</option>
                <option value="BB">Barbados</option>
                <option value="BY">Belarus</option>
                <option value="BE">Belgium</option>
                <option value="BZ">Belize</option>
                <option value="BJ">Benin</option>
                <option value="BM">Bermuda</option>
                <option value="BT">Bhutan</option>
                <option value="BO">Bolivia</option>
                <option value="BQ">Bonaire, St. Eustatius, Saba</option>
                <option value="BA">Bosnia</option>
                <option value="BW">Botswana</option>
                <option value="BR">Brazil</option>
                <option value="VG">British Virgin Isles</option>
                <option value="BN">Brunei</option>
                <option value="BG">Bulgaria</option>
                <option value="BF">Burkina Faso</option>
                <option value="BI">Burundi</option>
                <option value="KH">Cambodia</option>
                <option value="CM">Cameroon</option>
                <option value="CA">Canada</option>
                <option value="IC">Canary Islands</option>
                <option value="CV">Cape Verde</option>
                <option value="KY">Cayman Islands</option>
                <option value="CF">Central African Republic</option>
                <option value="XC">Ceuta</option>
                <option value="TD">Chad</option>
                <option value="CL">Chile</option>
                <option value="CN">China, People's Republic of</option>
                <option value="CO">Colombia</option>
                <option value="KM">Comoros</option>
                <option value="CG">Congo</option>
                <option value="CK">Cook Islands</option>
                <option value="CR">Costa Rica</option>
                <option value="HR">Croatia</option>
                <option value="CW">Curacao</option>
                <option value="CY">Cyprus</option>
                <option value="CZ">Czech Republic</option>
                <option value="CD">Democratic Republic of Congo</option>
                <option value="DK">Denmark</option>
                <option value="DJ">Djibouti</option>
                <option value="DM">Dominica</option>
                <option value="DO">Dominican Republic</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypt</option>
                <option value="SV">El Salvador</option>
                <option value="EN">England</option>
                <option value="GQ">Equatorial Guinea</option>
                <option value="ER">Eritrea</option>
                <option value="EE">Estonia</option>
                <option value="ET">Ethiopia</option>
                <option value="FO">Faeroe Islands</option>
                <option value="FJ">Fiji</option>
                <option value="FI">Finland</option>
                <option value="FR">France</option>
                <option value="GF">French Guiana</option>
                <option value="PF">French Polynesia</option>
                <option value="GA">Gabon</option>
                <option value="GM">Gambia</option>
                <option value="GE">Georgia</option>
                <option value="DE">Germany</option>
                <option value="GH">Ghana</option>
                <option value="GI">Gibraltar</option>
                <option value="GR">Greece</option>
                <option value="GL">Greenland</option>
                <option value="GD">Grenada</option>
                <option value="GP">Guadeloupe</option>
                <option value="GU">Guam</option>
                <option value="GT">Guatemala</option>
                <option value="GG">Guernsey</option>
                <option value="GN">Guinea</option>
                <option value="GW">Guinea-Bissau</option>
                <option value="GY">Guyana</option>
                <option value="HT">Haiti</option>
                <option value="HO">Holland</option>
                <option value="HN">Honduras</option>
                <option value="HK">Hong Kong</option>
                <option value="HU">Hungary</option>
                <option value="IS">Iceland</option>
                <option value="IN">India</option>
                <option value="ID">Indonesia</option>
                <option value="IQ">Iraq</option>
                <option value="IE">Ireland, Republic of</option>
                <option value="IL">Israel</option>
                <option value="IT">Italy</option>
                <option value="CI">Ivory Coast</option>
                <option value="JM">Jamaica</option>
                <option value="JP">Japan</option>
                <option value="JE">Jersey</option>
                <option value="JO">Jordan</option>
                <option value="KZ">Kazakhstan</option>
                <option value="KE">Kenya</option>
                <option value="KI">Kiribati</option>
                <option value="KO">Kosrae</option>
                <option value="KW">Kuwait</option>
                <option value="KG">Kyrgyzstan</option>
                <option value="LA">Laos</option>
                <option value="LV">Latvia</option>
                <option value="LB">Lebanon</option>
                <option value="LS">Lesotho</option>
                <option value="LR">Liberia</option>
                <option value="LY">Libya</option>
                <option value="LI">Liechtenstein</option>
                <option value="LT">Lithuania</option>
                <option value="LU">Luxembourg</option>
                <option value="MO">Macau</option>
                <option value="MK">Macedonia (Fyrom)</option>
                <option value="MG">Madagascar</option>
                <option value="M3">Madeira</option>
                <option value="MW">Malawi</option>
                <option value="MY">Malaysia</option>
                <option value="MV">Maldives</option>
                <option value="ML">Mali</option>
                <option value="MT">Malta</option>
                <option value="MH">Marshall Islands</option>
                <option value="MQ">Martinique</option>
                <option value="MR">Mauritania</option>
                <option value="MU">Mauritius</option>
                <option value="YT">Mayotte</option>
                <option value="XL">Melilla</option>
                <option value="MX">Mexico</option>
                <option value="FM">Micronesia</option>
                <option value="MD">Moldova</option>
                <option value="MC">Monaco</option>
                <option value="MN">Mongolia</option>
                <option value="ME">Montenegro</option>
                <option value="MS">Montserrat</option>
                <option value="MA">Morocco</option>
                <option value="MZ">Mozambique</option>
                <option value="MP">N. Mariana Islands</option>
                <option value="NA">Namibia</option>
                <option value="NP">Nepal</option>
                <option value="NL">Netherlands</option>
                <option value="NC">New Caledonia</option>
                <option value="NZ">New Zealand</option>
                <option value="NI">Nicaragua</option>
                <option value="NE">Niger</option>
                <option value="NG">Nigeria</option>
                <option value="NF">Norfolk Island</option>
                <option value="NB">Northern Ireland</option>
                <option value="NO">Norway</option>
                <option value="OM">Oman</option>
                <option value="PK">Pakistan</option>
                <option value="PW">Palau</option>
                <option value="PA">Panama</option>
                <option value="PG">Papua New Guinea</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PH">Philippines</option>
                <option value="PL">Poland</option>
                <option value="PO">Ponape</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="QA">Qatar</option>
                <option value="RE">Reunion</option>
                <option value="RO">Romania</option>
                <option value="RT">Rota</option>
                <option value="RU">Russia</option>
                <option value="RW">Rwanda</option>
                <option value="S1">Saba</option>
                <option value="SP">Saipan</option>
                <option value="WS">Samoa</option>
                <option value="ST">Sao Tome/Principe</option>
                <option value="SM">San Marino</option>
                <option value="SA">Saudi Arabia</option>
                <option value="SF">Scotland</option>
                <option value="SN">Senegal</option>
                <option value="RS">Serbia</option>
                <option value="SC">Seychelles</option>
                <option value="SL">Sierra Leone</option>
                <option value="SG">Singapore</option>
                <option value="SK">Slovakia</option>
                <option value="SI">Slovenia</option>
                <option value="SB">Solomon Islands</option>
                <option value="ZA">South Africa</option>
                <option value="KR">South Korea</option>
                <option value="ES">Spain</option>
                <option value="LK">Sri Lanka</option>
                <option value="BL">St. Barthelemy</option>
                <option value="SW">St. Christopher</option>
                <option value="C3">St. Croix</option>
                <option value="E2">St. Eustatius</option>
                <option value="UV">St. John</option>
                <option value="KN">St. Kitts &amp; Nevis</option>
                <option value="LC">St. Lucia</option>
                <option value="SX">St. Maarten and St. Martin</option>
                <option value="VL">St. Thomas</option>
                <option value="VC">St. Vincent/Grenadines</option>
                <option value="SR">Suriname</option>
                <option value="SZ">Swaziland</option>
                <option value="SE">Sweden</option>
                <option value="CH">Switzerland</option>
                <option value="SY">Syria</option>
                <option value="TA">Tahiti</option>
                <option value="TW">Taiwan</option>
                <option value="TJ">Tajikistan</option>
                <option value="TZ">Tanzania</option>
                <option value="TH">Thailand</option>
                <option value="TL">Timor Leste</option>
                <option value="TI">Tinian</option>
                <option value="TG">Togo</option>
                <option value="TO">Tonga</option>
                <option value="ZZ">Tortola</option>
                <option value="TT">Trinidad &amp; Tobago</option>
                <option value="TU">Truk</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="TM">Turkmenistan</option>
                <option value="TC">Turks &amp; Caicos Islands</option>
                <option value="TV">Tuvalu</option>
                <option value="UG">Uganda</option>
                <option value="UA">Ukraine</option>
                <option value="UI">Union Island</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                -->
                <option value="US">United States</option>
                <!--
                <option value="UY">Uruguay</option>
                <option value="VI">US Virgin Islands</option>
                <option value="UZ">Uzbekistan</option>
                <option value="VU">Vanuatu</option>
                <option value="VA">Vatican City State</option>
                <option value="VE">Venezuela</option>
                <option value="VN">Vietnam</option>
                <option value="VR">Virgin Gorda</option>
                <option value="WL">Wales</option>
                <option value="WF">Wallis &amp; Futuna Islands</option>
                <option value="YA">Yap</option>
                <option value="YE">Yemen</option>
                <option value="ZM">Zambia</option>
                <option value="ZW">Zimbabwe</option>
                -->
            </select>
        </div>

        <input type="submit" value="Checkout" class="button suggested-action">
    </div>
</form>

    <?php
        } else {
    ?>

<div class="row">
    <h3>You have no items in your cart</h3>
    <a href="/store/">Pick up some swag</a>
</div>

    <?php
        }
    ?>

<?php
    include $template['footer'];
?>
