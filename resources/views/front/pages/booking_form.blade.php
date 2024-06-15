@extends('layouts.front_master')
@section('title', 'Booking Form')
@section('content')
<section class=" py-5 contact_content">
  <div class="container">
    <div class="text-wrapper row">
      <div class="col-sm-12">
        <h1 class="section_title">Booking form </h1>
        <div class="row my-5">
          <div class="col-sm-12">
            <div class="review_form booking_form">
              <form role="form">
                <div class="row">
                  <div class="col-sm-12 mt-3">
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label class="control-label">
                          <label class="control-label"> Full Name </label>
                          <input class="form-control" type="text" placeholder="Full Name">
                        </label>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">Email Address</label>
                        <input class="form-control" type="email" placeholder="Email Id">
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">Phone no.</label>
                        <input class="form-control" type="tel" placeholder="Phone no.">
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="control-label"> Address</label>
                        <input class="form-control" type="text" placeholder="Address">
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">From</label>
                        <div class="select_dropdown">
                          <select name="destination" class="form-control" required="">
                            <option value="" selected="">Destination</option>
                            <option>Afghan</option>
                            <option>cabin 1</option>
                            <option>Algerian</option>
                            <option>American</option>
                            <option>Andorran</option>
                            <option>Angolan</option>
                            <option>Antiguans</option>
                            <option>Argentinian</option>
                            <option>Armenian</option>
                            <option>Australian</option>
                            <option>Austrian</option>
                            <option>Azerbaijani</option>
                            <option>Bahamian</option>
                            <option>Bahraini</option>
                            <option>Bangladeshi</option>
                            <option>Barbadian</option>
                            <option>Barbudans</option>
                            <option>Botswana</option>
                            <option>Belarussian</option>
                            <option>Belgian</option>
                            <option>Belizean</option>
                            <option>Beninese</option>
                            <option>Bhutanese</option>
                            <option>Bolivian</option>
                            <option>Bosnian</option>
                            <option>Brazilian</option>
                            <option>British</option>
                            <option>Bruneian</option>
                            <option>Bulgarian</option>
                            <option>Burkinabe</option>
                            <option>Burmese</option>
                            <option>Burundian</option>
                            <option>Cambodian</option>
                            <option>Cameroonian</option>
                            <option>Canadian</option>
                            <option>Cape Verdean</option>
                            <option>Central African</option>
                            <option>Chadian</option>
                            <option>Chilean</option>
                            <option>Chinese</option>
                            <option>Colombian</option>
                            <option>Comoran</option>
                            <option>Congolese</option>
                            <option>Costa Rican</option>
                            <option>Croatian</option>
                            <option>Cuban</option>
                            <option>Cypriot</option>
                            <option>Czech</option>
                            <option>Danish</option>
                            <option>Djibouti</option>
                            <option>Dominican</option>
                            <option>Dutch</option>
                            <option>East Timorese</option>
                            <option>Ecuadorean</option>
                            <option>Egyptian</option>
                            <option>Emirati</option>
                            <option>Equatorial Guinean</option>
                            <option>Eritrean</option>
                            <option>Estonian</option>
                            <option>Ethiopian</option>
                            <option>Fijian</option>
                            <option>Filipino</option>
                            <option>Finnish</option>
                            <option>French</option>
                            <option>Gabonese</option>
                            <option>Gambian</option>
                            <option>Georgian</option>
                            <option>German</option>
                            <option>Ghanaian</option>
                            <option>Greek</option>
                            <option>Grenadian</option>
                            <option>Guatemalan</option>
                            <option>Guinea-Bissauan</option>
                            <option>Guinean</option>
                            <option>Guyanese</option>
                            <option>Haitian</option>
                            <option>Honduran</option>
                            <option>Hungarian</option>
                            <option>Icelander</option>
                            <option>Indian</option>
                            <option>Indonesian</option>
                            <option>Iranian</option>
                            <option>Iraqi</option>
                            <option>Irish</option>
                            <option>Israeli</option>
                            <option>Italian</option>
                            <option>Ivorian</option>
                            <option>Jamaican</option>
                            <option>Japanese</option>
                            <option>Jordanian</option>
                            <option>Kazakhstani</option>
                            <option>Kenyan</option>
                            <option>Kiribati</option>
                            <option>Kittian and Nevisian</option>
                            <option>Kuwaiti</option>
                            <option>Kyrgyz</option>
                            <option>Laotian</option>
                            <option>Latvian</option>
                            <option>Lebanese</option>
                            <option>Liberian</option>
                            <option>Libyan</option>
                            <option>Liechtensteiner</option>
                            <option>Lithuanian</option>
                            <option>Luxembourger</option>
                            <option>Macedonian</option>
                            <option>Malagasy</option>
                            <option>Malawian</option>
                            <option>Malaysian</option>
                            <option>Maldivan</option>
                            <option>Malian</option>
                            <option>Maltese</option>
                            <option>Marshallese</option>
                            <option>Mauritanian</option>
                            <option>Mauritian</option>
                            <option>Mexican</option>
                            <option>Micronesian</option>
                            <option>Moldovan</option>
                            <option>Monacan</option>
                            <option>Mongolian</option>
                            <option>Moroccan</option>
                            <option>Mosotho</option>
                            <option>Motswana</option>
                            <option>Mozambican</option>
                            <option>Namibian</option>
                            <option>Nauruan</option>
                            <option>Nepalese</option>
                            <option>New Zealander</option>
                            <option>Nicaraguan</option>
                            <option>Nigerian</option>
                            <option>North Korean</option>
                            <option>Norwegian</option>
                            <option>Omani</option>
                            <option>Pakistani</option>
                            <option>Palauan</option>
                            <option>Panamanian</option>
                            <option>Papua New Guinean</option>
                            <option>Paraguayan</option>
                            <option>Peruvian</option>
                            <option>Polish</option>
                            <option>Portuguese</option>
                            <option>Qatari</option>
                            <option>Romanian</option>
                            <option>Russian</option>
                            <option>Rwandan</option>
                            <option>St. Lucian</option>
                            <option>Salvadoran</option>
                            <option>Samoan</option>
                            <option>San Marinese</option>
                            <option>Sao Tomean</option>
                            <option>Saudi</option>
                            <option>Senegalese</option>
                            <option>Serbian</option>
                            <option>Seychellois</option>
                            <option>Sierra Leonean</option>
                            <option>Singaporean</option>
                            <option>Slovakian</option>
                            <option>Slovenian</option>
                            <option>Solomon Islander</option>
                            <option>Somali</option>
                            <option>South African</option>
                            <option>South Korean</option>
                            <option>Spanish</option>
                            <option>Sri Lankan</option>
                            <option>Sudanese</option>
                            <option>Surinamer</option>
                            <option>Swazi</option>
                            <option>Swedish</option>
                            <option>Swiss</option>
                            <option>Syrian</option>
                            <option>Taiwanese</option>
                            <option>Tajik</option>
                            <option>Tanzanian</option>
                            <option>Thai</option>
                            <option>Togolese</option>
                            <option>Tongan</option>
                            <option>Trinidadian</option>
                            <option>Tunisian</option>
                            <option>Turkish</option>
                            <option>Tuvaluan</option>
                            <option>Ugandan</option>
                            <option>Ukrainian</option>
                            <option>Uruguayan</option>
                            <option>Uzbekistani</option>
                            <option>Venezuelan</option>
                            <option>Vietnamese</option>
                            <option>West Indian</option>
                            <option>Yemenite</option>
                            <option>Zambian</option>
                            <option>Zimbabwean</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">To</label>
                        <div class="select_dropdown">
                          <select name="destination" class="form-control" required="">
                            <option value="" selected="">Destination</option>
                            <option>Afghan</option>
                            <option>Albanian</option>
                            <option>Algerian</option>
                            <option>American</option>
                            <option>Andorran</option>
                            <option>Angolan</option>
                            <option>Antiguans</option>
                            <option>Argentinian</option>
                            <option>Armenian</option>
                            <option>Australian</option>
                            <option>Austrian</option>
                            <option>Azerbaijani</option>
                            <option>Bahamian</option>
                            <option>Bahraini</option>
                            <option>Bangladeshi</option>
                            <option>Barbadian</option>
                            <option>Barbudans</option>
                            <option>Botswana</option>
                            <option>Belarussian</option>
                            <option>Belgian</option>
                            <option>Belizean</option>
                            <option>Beninese</option>
                            <option>Bhutanese</option>
                            <option>Bolivian</option>
                            <option>Bosnian</option>
                            <option>Brazilian</option>
                            <option>British</option>
                            <option>Bruneian</option>
                            <option>Bulgarian</option>
                            <option>Burkinabe</option>
                            <option>Burmese</option>
                            <option>Burundian</option>
                            <option>Cambodian</option>
                            <option>Cameroonian</option>
                            <option>Canadian</option>
                            <option>Cape Verdean</option>
                            <option>Central African</option>
                            <option>Chadian</option>
                            <option>Chilean</option>
                            <option>Chinese</option>
                            <option>Colombian</option>
                            <option>Comoran</option>
                            <option>Congolese</option>
                            <option>Costa Rican</option>
                            <option>Croatian</option>
                            <option>Cuban</option>
                            <option>Cypriot</option>
                            <option>Czech</option>
                            <option>Danish</option>
                            <option>Djibouti</option>
                            <option>Dominican</option>
                            <option>Dutch</option>
                            <option>East Timorese</option>
                            <option>Ecuadorean</option>
                            <option>Egyptian</option>
                            <option>Emirati</option>
                            <option>Equatorial Guinean</option>
                            <option>Eritrean</option>
                            <option>Estonian</option>
                            <option>Ethiopian</option>
                            <option>Fijian</option>
                            <option>Filipino</option>
                            <option>Finnish</option>
                            <option>French</option>
                            <option>Gabonese</option>
                            <option>Gambian</option>
                            <option>Georgian</option>
                            <option>German</option>
                            <option>Ghanaian</option>
                            <option>Greek</option>
                            <option>Grenadian</option>
                            <option>Guatemalan</option>
                            <option>Guinea-Bissauan</option>
                            <option>Guinean</option>
                            <option>Guyanese</option>
                            <option>Haitian</option>
                            <option>Honduran</option>
                            <option>Hungarian</option>
                            <option>Icelander</option>
                            <option>Indian</option>
                            <option>Indonesian</option>
                            <option>Iranian</option>
                            <option>Iraqi</option>
                            <option>Irish</option>
                            <option>Israeli</option>
                            <option>Italian</option>
                            <option>Ivorian</option>
                            <option>Jamaican</option>
                            <option>Japanese</option>
                            <option>Jordanian</option>
                            <option>Kazakhstani</option>
                            <option>Kenyan</option>
                            <option>Kiribati</option>
                            <option>Kittian and Nevisian</option>
                            <option>Kuwaiti</option>
                            <option>Kyrgyz</option>
                            <option>Laotian</option>
                            <option>Latvian</option>
                            <option>Lebanese</option>
                            <option>Liberian</option>
                            <option>Libyan</option>
                            <option>Liechtensteiner</option>
                            <option>Lithuanian</option>
                            <option>Luxembourger</option>
                            <option>Macedonian</option>
                            <option>Malagasy</option>
                            <option>Malawian</option>
                            <option>Malaysian</option>
                            <option>Maldivan</option>
                            <option>Malian</option>
                            <option>Maltese</option>
                            <option>Marshallese</option>
                            <option>Mauritanian</option>
                            <option>Mauritian</option>
                            <option>Mexican</option>
                            <option>Micronesian</option>
                            <option>Moldovan</option>
                            <option>Monacan</option>
                            <option>Mongolian</option>
                            <option>Moroccan</option>
                            <option>Mosotho</option>
                            <option>Motswana</option>
                            <option>Mozambican</option>
                            <option>Namibian</option>
                            <option>Nauruan</option>
                            <option>Nepalese</option>
                            <option>New Zealander</option>
                            <option>Nicaraguan</option>
                            <option>Nigerian</option>
                            <option>North Korean</option>
                            <option>Norwegian</option>
                            <option>Omani</option>
                            <option>Pakistani</option>
                            <option>Palauan</option>
                            <option>Panamanian</option>
                            <option>Papua New Guinean</option>
                            <option>Paraguayan</option>
                            <option>Peruvian</option>
                            <option>Polish</option>
                            <option>Portuguese</option>
                            <option>Qatari</option>
                            <option>Romanian</option>
                            <option>Russian</option>
                            <option>Rwandan</option>
                            <option>St. Lucian</option>
                            <option>Salvadoran</option>
                            <option>Samoan</option>
                            <option>San Marinese</option>
                            <option>Sao Tomean</option>
                            <option>Saudi</option>
                            <option>Senegalese</option>
                            <option>Serbian</option>
                            <option>Seychellois</option>
                            <option>Sierra Leonean</option>
                            <option>Singaporean</option>
                            <option>Slovakian</option>
                            <option>Slovenian</option>
                            <option>Solomon Islander</option>
                            <option>Somali</option>
                            <option>South African</option>
                            <option>South Korean</option>
                            <option>Spanish</option>
                            <option>Sri Lankan</option>
                            <option>Sudanese</option>
                            <option>Surinamer</option>
                            <option>Swazi</option>
                            <option>Swedish</option>
                            <option>Swiss</option>
                            <option>Syrian</option>
                            <option>Taiwanese</option>
                            <option>Tajik</option>
                            <option>Tanzanian</option>
                            <option>Thai</option>
                            <option>Togolese</option>
                            <option>Tongan</option>
                            <option>Trinidadian</option>
                            <option>Tunisian</option>
                            <option>Turkish</option>
                            <option>Tuvaluan</option>
                            <option>Ugandan</option>
                            <option>Ukrainian</option>
                            <option>Uruguayan</option>
                            <option>Uzbekistani</option>
                            <option>Venezuelan</option>
                            <option>Vietnamese</option>
                            <option>West Indian</option>
                            <option>Yemenite</option>
                            <option>Zambian</option>
                            <option>Zimbabwean</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">Arrive Date</label>
                        <input class="form-control date" type="date">
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label">Return Date</label>
                        <input class="form-control date" type="date">
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="control-label"> Cabin Class</label>
                        <div class="select_dropdown">
                          <select name="cabin" class="form-control" required="">
                            <option value="" selected="">Select</option>
                            <option>cabin 1</option>
                            <option>cabin 2</option>
                            <option>cabin 3</option>
                            <option>cabin 4</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="row">
                          <div class="col-sm-12">
                            <label class="control-label"> No of Passengers</label>
                          </div>
                          <div class="form-group col-sm-6">
                            <div class="select_dropdown">
                              <select name="passengers" class="form-control" required="">
                                <option value="" selected="">No. of Adult</option>
                                <option>Adult 1</option>
                                <option>Adult 2</option>
                                <option>Adult 3</option>
                                <option>Adult 4</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group col-sm-6">
                            <div class="select_dropdown">
                              <select name="passengers" class="form-control" required="">
                                <option value="" selected="">No. of Children</option>
                                <option>Child 1</option>
                                <option>Child 2</option>
                                <option>Child 3</option>
                                <option>Child 4</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-sm-12"> <a href="#" class="btn view_btn send_btn">Submit</a> </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection