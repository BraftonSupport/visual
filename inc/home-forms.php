<?php 
/* These forms appear on the homepage! */
?>
<style type="text/css">
			  .error{
			    padding: 5px 9px;
			    border: 1px solid red;
			    color: red;
			    border-radius: 3px;
			  }
			 
			  .success{
			    padding: 5px 9px;
			    border: 1px solid green;
			    color: green;
			    border-radius: 3px;
			  }
			 
			  form span{
			    color: red;
			  }
			</style>

			<?php echo $response; ?>
			
			<!-- MM form -->
			<div class="home-form" id="prop-form" style="display: none;">
			  <form action="<?php the_permalink(); ?>" method="post">
			  	<div class="dropdown">
			  		<div class="full-width">
			  			<a class="button back" href="#">&laquo; Back</a>
			  		</div>
			  		<div class="form-left">
			  			<!-- industry -->
			  			<label for "revenue">NAICS/Industry Type:</label>
				  		<select name="message_options" id="revenue">
				  			<option value="" disabled selected>-- Select --</option>
				  			<?php $cats = getCatNAICS();
					  			foreach ($cats as $cat => $value) {
					  				print "<option value='" . $value['naics_category_name'] . "'>" . $value['naics_category_name'] . "</option>";
					  			}
				  			?>
				  		</select>
				  		<!-- other -->
				  		<label for="name">Other Industry (please specify): <br><input type="text" name="message_other" value="<?php echo esc_attr($_POST['message_other']); ?>"></label>
				  		<!-- revenue -->
				  		<label for "naics">Amount of Revenue/year($):</label>
				  		<select name="message_options" id="naics">
				  			<option value="" disabled selected>-- Select --</option>
				  			<option value="New Business">New Business</option>
				  			<option value="$1 to $50,000">$1 to $50,000</option>
				  			<option value="$50,000 to $500,000">$50,000 to $500,000</option>
				  			<option value="$500,000 to $2,000,000">$500,000 to $2,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$2,000,000 to $10,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$10,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$2,000,000 to $10,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$10,000,000 to $50,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$50,000,000 to $200,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$200,000,000 to $500,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$500,000,000 to $2 Billion</option>
				  			<option value="$2,000,000 to $10,000,000">$2 Billion</option>
				  		</select>
				  	</div>
				  	<div class="form-right">
				  		<!-- country -->
				  		<label for "country">Country:</label>
				  		  <select name="country" id="country">
				  			<option value="" disabled selected>-- Select --</option>
				              <option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia, Plurinational State Of">Bolivia, Plurinational State Of</option><option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo, The Democratic Republic Of The">Congo, The Democratic Republic Of The</option><option value="Costa Rica">Costa Rica</option><option value="Cote Dâ€™Ivoire">Cote Dâ€™Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic Peopleâ€™s Republic Of">Korea, Democratic Peopleâ€™s Republic Of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao Peopleâ€™s Democratic Republic">Lao Peopleâ€™s Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia, the Former Yugoslav Republic Of">Macedonia, the Former Yugoslav Republic Of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States Of">Micronesia, Federated States Of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena, Ascension and Tristan Da Cunha">Saint Helena, Ascension and Tristan Da Cunha</option><option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Sudan">South Sudan</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Province Of China">Taiwan, Province Of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option><option value="Viet Nam">Viet Nam</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>            
				          	</select>
				          <!-- years in biz -->
				          <label for "years">How many years in business?:</label>
				          	<select id="years" tabindex="14" name="years_in_business" class="valid">
							  <option value=""> -- Select --- </option>
							  <option value="1">New business</option>
							  <option value="2">1-2 years</option>
							  <option value="3">3-5 years</option>
							  <option value="4">6-10 years</option>
							  <option value="5">11+ years</option>
							</select>
						</div>
						<div class="full-width">
			  				<a class="button next" href="#">Next &raquo;</a>
			  			</div>
			  	</div>

			  	<div class="rest" style="display: none;">
			  		<div class="full-width">
			  			<a class="button drop-back" href="#">&laquo; Back</a>
			  		</div>
			  		<div class="form-left">
					    <label for="name">Name: <br><input type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>"></label>
					    <label for="message_email">Email: <span>*</span><br /><input type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></label>
					</div>
					<div class="form-right">
					    <h3>Upload Documents:</h3>
					    <p><label for="upload_file">Insurance Schedule: <span>*</span><br /><input type="file" name="upload_file"></label></p>
					    <p><label for "multi_file_upload">Supporting Documents:<br /><input type="file" name="multi_file_upload" multiple></label></p>
					   	<p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
					</div>
					<div class="full-width">
					    <input type="hidden" name="submitted" value="1">
				    	<input type="submit">
				    </div>
				</div>
			  </form>
			</div>

			<!-- GB form -->
			<div class="home-form" id="group-form" style="display: none;">
			  <form action="<?php the_permalink(); ?>" method="post">
			  	<div class="dropdown">
			  		<div class="full-width">
			  			<a class="back button" href="#">&laquo; Back</a>
			  		</div>
			  		<!-- industry -->
			  		<div class="form-left">
				  		<label for "revenue">NAICS Type:</label>
				  		<select name="message_options" id="revenue">
				  			<option value="" disabled selected>-- Select --</option>
				  			<?php $cats = getCatNAICS();
					  			foreach ($cats as $cat => $value) {
					  				print "<option value='" . $value['naics_category_name'] . "'>" . $value['naics_category_name'] . "</option>";
					  			}
				  			?>
				  		</select>
				  		<!-- other -->
				  		<label for="name">Other Industry (please specify): <br><input type="text" name="message_other" value="<?php echo esc_attr($_POST['message_other']); ?>"></label>
				  		<!-- # employees -->
				  		<label for "employees">Number of Employees:</label>
				  		<select name="message_options" id="employees">
				  			<option value="" disabled selected>-- Select --</option>
				  			<?php $lives = getNumEmployees();
					  			foreach ($lives as $life => $value) {
					  				print "<option value='" . $value . "'>" . formatEmployeeRange($value) . "</option>";
					  			}
				  			?>
				  		</select>
			  		</div>
			  		<div class="form-right">
			  			<!-- country -->
				  		<label for "country">Country:</label>
				  		  <select name="country" id="country">
				  			<option value="" disabled selected>-- Select --</option>
				              <option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia, Plurinational State Of">Bolivia, Plurinational State Of</option><option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo, The Democratic Republic Of The">Congo, The Democratic Republic Of The</option><option value="Costa Rica">Costa Rica</option><option value="Cote Dâ€™Ivoire">Cote Dâ€™Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic Peopleâ€™s Republic Of">Korea, Democratic Peopleâ€™s Republic Of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao Peopleâ€™s Democratic Republic">Lao Peopleâ€™s Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia, the Former Yugoslav Republic Of">Macedonia, the Former Yugoslav Republic Of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States Of">Micronesia, Federated States Of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena, Ascension and Tristan Da Cunha">Saint Helena, Ascension and Tristan Da Cunha</option><option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Sudan">South Sudan</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Province Of China">Taiwan, Province Of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option><option value="Viet Nam">Viet Nam</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>            
				          	</select>
				          <!-- years in biz -->
				          <label for "years">How many years in business?:</label>
				          	<select id="years" tabindex="14" name="years_in_business" class="valid">
							  <option value=""> -- Select --- </option>
							  <option value="1">New business</option>
							  <option value="2">1-2 years</option>
							  <option value="3">3-5 years</option>
							  <option value="4">6-10 years</option>
							  <option value="5">11+ years</option>
							</select>
						</div>
						<div class="full-width">
			  				<a class="button next" href="#">Next &raquo;</a>
			  			</div>
			  	</div>
			  	<div class="rest" style="display: none;">
			  		<div class="full-width">
			  			<a class="drop-back button" href="#">&laquo; Back</a>
			  		</div>
			  		<div class="form-left">
					    <label for="name">Name: <br><input type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>"></label>
					    <label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></label>
					</div>
					<div class="form-right">
					    <h3>Upload Documents:</h3>
					    	<label for="upload_file">Medical Renewal Letter: <span>*</span><br /><input type="file" name="upload_file"></label><br />
					    	<label for "multi_file_upload">Supporting Documents (Summary Plan Description, Employee Census, Last 2 Medical Monthly Billing Statements):<br /><input type="file" name="multi_file_upload" multiple></label>
					    </p>
					    <p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
					</div>
					<div class="full-width">
					    <input type="hidden" name="submitted" value="1">
					    <input type="submit">
					</div>
				</div>
			  </form>
			</div>

			<!-- PC form -->
			<div class="home-form" id="ret-form" style="display: none;">
			  <form action="<?php the_permalink(); ?>" method="post" enctype="multipart/form-data">
			  	<div class="dropdown">
			  		<div class="full-width">
			  			<a class="back button" href="#">&laquo; Back</a>
			  		</div>
			  		<div class="form-left">
			  		<!-- industry -->
				  		<label for "revenue">NAICS Type:</label>
				  		<select name="message_options" id="revenue">
				  			<option value="" disabled selected>-- Select --</option>
				  			<?php $cats = getCatNAICS();
					  			foreach ($cats as $cat => $value) {
					  				print "<option value='" . $value['naics_category_name'] . "'>" . $value['naics_category_name'] . "</option>";
					  			}
				  			?>
				  		</select>
				  		<!-- other -->
				  		<label for="name">Other Industry (please specify): <br><input type="text" name="message_other" value="<?php echo esc_attr($_POST['message_other']); ?>"></label>
				  		<!-- # employees -->
				  		<label for "employees">Number of Employees:</label>
				  		<select name="message_options" id="employees">
				  			<option value="" disabled selected>-- Select --</option>
				  			<?php $lives = getNumEmployees();
					  			foreach ($lives as $life => $value) {
					  				print "<option value='" . $value . "'>" . formatEmployeeRange($value) . "</option>";
					  			}
				  			?>
				  		</select>
			  		</div>
			  		<div class="form-right">
				  		<!-- $ assets -->
				  		<label for "naics">Retirement Plan Assets:</label>
				  		<select name="message_options" id="naics">
				  			<option value="" disabled selected>-- Select --</option>
				  			<option value="New Business">New Business</option>
				  			<option value="$1 to $50,000">$1 to $50,000</option>
				  			<option value="$50,000 to $500,000">$50,000 to $500,000</option>
				  			<option value="$500,000 to $2,000,000">$500,000 to $2,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$2,000,000 to $10,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$10,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$2,000,000 to $10,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$10,000,000 to $50,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$50,000,000 to $200,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$200,000,000 to $500,000,000</option>
				  			<option value="$2,000,000 to $10,000,000">$500,000,000 to $2 Billion</option>
				  			<option value="$2,000,000 to $10,000,000">$2 Billion</option>
				  		</select>
				  		<!-- country -->
				  		<label for "country">Country:</label>
				  		  <select name="country" id="country">
				  			<option value="" disabled selected>-- Select --</option>
				              <option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia, Plurinational State Of">Bolivia, Plurinational State Of</option><option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo, The Democratic Republic Of The">Congo, The Democratic Republic Of The</option><option value="Costa Rica">Costa Rica</option><option value="Cote Dâ€™Ivoire">Cote Dâ€™Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic Peopleâ€™s Republic Of">Korea, Democratic Peopleâ€™s Republic Of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao Peopleâ€™s Democratic Republic">Lao Peopleâ€™s Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia, the Former Yugoslav Republic Of">Macedonia, the Former Yugoslav Republic Of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States Of">Micronesia, Federated States Of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena, Ascension and Tristan Da Cunha">Saint Helena, Ascension and Tristan Da Cunha</option><option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Sudan">South Sudan</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Province Of China">Taiwan, Province Of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option><option value="Viet Nam">Viet Nam</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>            
				          	</select>
				          <!-- years in biz -->
				          <label for "years">How many years in business?:</label>
				          	<select id="years" tabindex="14" name="years_in_business" class="valid">
							  <option value=""> -- Select --- </option>
							  <option value="1">New business</option>
							  <option value="2">1-2 years</option>
							  <option value="3">3-5 years</option>
							  <option value="4">6-10 years</option>
							  <option value="5">11+ years</option>
							</select>
						</div>
						<div class="full-width">
			  				<a class="button next" href="#">Next &raquo;</a>
			  			</div>
			  	</div>
			  	<div class="rest" style="display: none;">
			  		<div class="full-width">
			  			<a class="drop-back button" href="#">&laquo; Back</a>
			  		</div>
			  		<div class="form-left">
					    <label for="name">Name: <br><input type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>"></label>
					    <label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></label>
					</div>
					<div class="form-right">
					    <h3>Upload Documents:</h3>
					    	<p><label for="upload_file">Advisory Fee Agreement (if any):<br /><input type="file" name="upload_file"></label></p>
					    	<p><label for "multi_file_upload">Supporting Documents (408(b)3 Fee Schedule, Investment Policy Statement):<br /><input type="file" name="multi_file_upload" multiple></label></p>
					    <p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
					</div>
					<div class="full-width">
					    <input type="hidden" name="submitted" value="1">
					    <p><input type="submit"></p>
					</div>
				</div>
			  </form>
			</div>
			<!-- end forms -->