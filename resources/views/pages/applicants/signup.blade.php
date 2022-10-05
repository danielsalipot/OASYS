@extends('layout.applicant_app')
@include('inc.datatables')
    @section('content')
    <style>
        body{
                background-color: #d2edff;
            }
    </style>
    <div class="p-2"></div>
        <div class="text-center text-primary m-auto" style="height: 95vh;">
            <div class="row h-100" style="padding-top:4vh">
                <div class="col bg-white h-100 shadow-lg p-5 ms-5 me-0 rounded-start shadow-sm">
                    <div class="h-25">
                        <div class="row rounded p-0 mb-5">
                            <div class="border border-primary col bg-primary p-3 shadow-sm m-0 rounded-start"></div>
                            <div class="border border-primary col-1 p-1 bg-primary shadow-sm">Step 1</div>
                            <div class="border-top border-bottom border-primary col bg-light p-3 shadow-sm"></div>
                            <div class="border-top border-bottom border-primary col-1 p-1 bg-light text-secondary shadow-sm">Step 2</div>
                            <div class="border-top border-bottom border-primary col bg-light p-3 shadow-sm"></div>
                            <div class="border-top border-bottom border-end border-primary col-1 p-1 bg-light text-secondary rounded-end shadow-sm"> Step 3</div>
                        </div>
                        <h1 class="section-title">Create your Account</h1>
                    </div>
                    <div class="h-50">
                        @if(Session::get('taken'))
                            <div class="alert alert-danger w-100 m-auto">{{Session::get('taken')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger w-100 m-auto">{{Session::get('fail')}}</div>
                        @endif
                        @if(Session::get('pass'))
                            <div class="alert alert-danger w-100 m-auto">{{Session::get('pass')}}</div>
                        @endif
                            @if(Session::get('chk_req'))
                            <div class="alert alert-danger w-100 m-auto">{{Session::get('chk_req')}}</div>
                        @endif


                        <form class="p-1" action="/applicant/crudsignup" method="post">
                            @csrf
                            <h6 class="text-secondary m-0 p-0 w-75 mx-auto text-start">Username</h6>
                            <input class="m-auto form-control w-75 mt-2 p-2 border-0 border-bottom" type="text" name="user" placeholder="Username" value="{{old('user')}}">
                            <span class="text-danger">@error('user'){{$message}}@enderror</span>

                            <h6 class="text-secondary m-0 p-0 w-75 mt-4 mx-auto text-start">Password</h6>
                            <input class="m-auto form-control w-75 mt-2 p-2 border-0 border-bottom" type="password" name="pass" placeholder="Password" value="{{old('pass')}}">
                            <span class="text-danger">@error('pass') {{$message}} @enderror</span>

                            <h6 class="text-secondary m-0 p-0 w-75 mt-4 mx-auto text-start">Confirm Password</h6>
                            <input class="m-auto form-control w-75 mt-2 p-2 border-0 border-bottom" type="password" name="repass" placeholder="Confirm Password" value="{{old('repass')}}">
                            <span class="text-danger">@error('repass'){{$message}}@enderror</span>

                            <br>

                            <div class="row w-75 mx-auto">
                                <div class="col-1 text-end p-0 pt-1 pe-2">
                                    <input type="checkbox" id="data_privacy_chk" onclick="consent_checkbox_click()" name="data_privacy_chk" value="1">
                                </div>
                                <div class="col-5 text-start p-0 pt-2">
                                    <p for="data_privacy_chk" class="text-dark text-decoration-none p-0 m-0"> I voluntarily consent to the use of my data.</p>
                                </div>
                                <div class="col"></div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-secondary shadow-sm border-0 border-bottom" data-toggle="modal" data-target="#data_privacy">
                                        Read Data Privacy Terms
                                    </button>
                                </div>
                            </div>


                            <div class="row w-75 mx-auto mt-3">
                                <div class="col-1 text-end p-0 pt-1 pe-2">
                                    <input type="checkbox" onclick="consent_checkbox_click()" id="terms_condition_chk" name="terms_condition_chk" value="1">
                                </div>
                                <div class="col-5 text-start p-0 pt-2">
                                    <p for="terms_condition_chk" class=" text-dark text-decoration-none p-0 m-0"> I agree to the terms and condition</p>
                                </div>
                                <div class="col"></div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-secondary shadow-sm border-0 border-bottom" data-toggle="modal" data-target="#term_conditions">
                                        Read Terms and Condition
                                    </button>
                                </div>
                            </div>
                    </div>

                    <div class="h-25">
                        <div class="row">
                            <button type="submit" disabled id="form_submit" class="btn btn-primary w-50 mx-auto mt-3 p-4 shadow-sm">Sign up</button>
                        </div>
                        <div class="row">
                            <a href="/" class="btn btn-outline-primary w-50 mt-1 mx-auto">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col m-0 p-0 me-5">
                    <img src="https://wallpaperaccess.com/full/155741.jpg"  class=" w-100 h-100  rounded-end shadow-sm" alt="">
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="data_privacy">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title w-100">Data Privacy Terms</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <p style="font-size:15px">
                            Your privacy is important to us, and we are committed to protecting it.
                            To maintain the privacy of your personal information, we will be processing your
                            data in accordance with RA 10173, also known as the Data Protection Act of 2012 (DPA of 2012),
                            and its Implementing Rules and Regulations. However, no technique of internet transmission or method
                            of computer storage is completely safe.
                        </p>

                        <p style="font-size:15px">
                            Purpose. This form is intended to collect information provided by the applicant that has been gathered throughout the entire process of registering for the system and utilizing its functions.
                            By filling up this form you are consenting to the collection, processing and use of the information in accordance to this privacy notice. The following are the personal data that we will collect:
                        </p>

                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li>E-mail</li>
                                    <li>Name</li>
                                    <li>Birthday</li>
                                    <li>Contact Number</li>
                                    <li>Age</li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li>Gender</li>
                                    <li>Picture</li>
                                    <li>Resume</li>
                                    <li>System Activities</li>
                                </ul>
                            </div>
                        </div>


                        <p style="font-size:15px">Your information is used for a variety of objectives, including access provision, attendance, monitoring, evaluation, documentation, and communication. Google is in charge of gathering and storing the data.</p>
                        <p style="font-size:15px">Data Protection. To secure your personal data, the University will take reasonable and suitable organizational, physical, and technical security measures. The data gathered and processed must only be accessed by authorized personnel.</p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- The Modal -->
        <div class="modal" id="term_conditions">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title w-100">Terms and Condition</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>
                            Welcome to OASYS (“Company”, “we”, “our”, “us”)!
                            These Terms of Service (“Terms”, “Terms of Service”) govern your use of our website located at https://oasys-services.herokuapp.com/ (together or individually “Service”) operated by OASYS.
                            Our Privacy Policy also governs your use of our Service and explains how we collect, safeguard and disclose information that results from your use of our web pages.
                            Your agreement with us includes these Terms and our Privacy Policy (“Agreements”). You acknowledge that you have read and understood Agreements, and agree to be bound of them.
                            If you do not agree with (or cannot comply with) Agreements, then you may not use the Service, but please let us know by emailing at oasys-services @gmail.com so we can try to find a solution. These Terms apply to all visitors, users and others who wish to access or use Service.
                        </p>

                        <h6>Content</h6>
                        <p>
                            OASYS has the right but not the obligation to monitor and edit all Content provided by users.
                            In addition, Content found on or through this Service are the property of OASYS or used with permission. You may not distribute, modify, transmit, reuse, download, repost, copy, or use said Content, whether in whole or in part, for commercial purposes or for personal gain, without express advance written permission from us.
                        </p>

                        <h6>Prohibited Uses</h6>
                        <p>
                            You may use Service only for lawful purposes and in accordance with Terms. You agree not to use Service:
                            <br>0.1. In any way that violates any applicable national or international law or regulation.
                            <br>0.2. For the purpose of exploiting, harming, or attempting to exploit or harm minors in any way by exposing them to inappropriate content or otherwise.
                            <br>0.3. To transmit, or procure the sending of, any advertising or promotional material, including any “junk mail”, “chain letter,” “spam,” or any other similar solicitation.
                            <br>0.4. To impersonate or attempt to impersonate Company, a Company employee, another user, or any other person or entity.
                            <br>0.5. In any way that infringes upon the rights of others, or in any way is illegal, threatening, fraudulent, or harmful, or in connection with any unlawful, illegal, fraudulent, or harmful purpose or activity.
                            <br>0.6. To engage in any other conduct that restricts or inhibits anyone’s use or enjoyment of Service, or which, as determined by us, may harm or offend Company or users of Service or expose them to liability.
                                Additionally, you agree not to:
                            <br>0.1. Use Service in any manner that could disable, overburden, damage, or impair Service or interfere with any other party’s use of Service, including their ability to engage in real time activities through Service.
                            <br>0.2. Use any robot, spider, or other automatic device, process, or means to access Service for any purpose, including monitoring or copying any of the material on Service.
                            <br>0.3. Use any manual process to monitor or copy any of the material on Service or for any other unauthorized purpose without our prior written consent.
                            <br>0.4. Use any device, software, or routine that interferes with the proper working of Service.
                            <br>0.5. Introduce any viruses, trojan horses, worms, logic bombs, or other material which is malicious or technologically harmful.
                            <br>0.6. Attempt to gain unauthorized access to, interfere with, damage, or disrupt any parts of Service, the server on which Service is stored, or any server, computer, or database connected to Service.
                            <br>0.7. Attack Service via a denial-of-service attack or a distributed denial-of-service attack.
                            <br>0.8. Take any action that may damage or falsify Company rating.
                            <br>0.9. Otherwise attempt to interfere with the proper working of Service.
                        </p>

                        <h6>No Use By Minors</h6>
                        <p>Service is intended only for access and use by individuals at least eighteen (18) years old. By accessing or using Service, you warrant and represent that you are at least eighteen (18) years of age and with the full authority, right, and capacity to enter into this agreement and abide by all of the terms and conditions of Terms. If you are not at least eighteen (18) years old, you are prohibited from both the access and usage of Service.</p>

                        <h6>Accounts</h6>
                        <p>
                            When you create an account with us, you guarantee that you are above the age of 18, and that the information you provide us is accurate, complete, and current at all times. Inaccurate, incomplete, or obsolete information may result in the immediate termination of your account on Service.
                            You are responsible for maintaining the confidentiality of your account and password, including but not limited to the restriction of access to your computer and/or account. You agree to accept responsibility for any and all activities or actions that occur under your account and/or password, whether your password is with our Service or a third-party service. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.
                            We reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in our sole discretion.
                        </p>

                        <h6>Intellectual Property</h6>
                        <p>
                            Service and its original content (excluding Content provided by users), features and functionality are and will remain the exclusive property of OASYS and its licensors. Service is protected by copyright, trademark, and other laws of and foreign countries. Our trademarks may not be used in connection with any product or service without the prior written consent of OASYS.
                        </p>

                        <h6>Error Reporting and Feedback</h6>
                        <p>
                            You may provide us either directly at oasys-services@gmail.com or via third party sites and tools with information and feedback concerning errors, suggestions for improvements, ideas, problems, complaints, and other matters related to our Service (“Feedback”). You acknowledge and agree that: (i) you shall not retain, acquire or assert any intellectual property right or other right, title or interest in or to the Feedback; (ii) Company may have development ideas similar to the Feedback; (iii) Feedback does not contain confidential information or proprietary information from you or any third party; and (iv) Company is not under any obligation of confidentiality with respect to the Feedback. In the event the transfer of the ownership to the Feedback is not possible due to applicable mandatory laws, you grant Company and its affiliates an exclusive, transferable, irrevocable, free-of-charge, sub-licensable, unlimited and perpetual right to use (including copy, modify, create derivative works, publish, distribute and commercialize) Feedback in any manner and for any purpose.
                        </p>

                        <h6>Termination</h6>
                        <p>
                            We may terminate or suspend your account and bar access to Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of Terms.
                            If you wish to terminate your account, you may simply discontinue using Service.
                            All provisions of Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.
                        </p>

                        <h6>Governing Law</h6>
                        <p>
                            These Terms shall be governed and construed in accordance with the laws of Philippines, which governing law applies to agreement without regard to its conflict of law provisions.
                            Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service and supersede and replace any prior agreements we might have had between us regarding Service.
                        </p>

                        <h6>Changes To Service</h6>
                        <p>
                            We reserve the right to withdraw or amend our Service, and any service or material we provide via Service, in our sole discretion without notice. We will not be liable if for any reason all or any part of Service is unavailable at any time or for any period. From time to time, we may restrict access to some parts of Service, or the entire Service, to users, including registered users.
                        </p>

                        <h6>Acknowledgement</h6>
                        <p>
                            BY USING SERVICE OR OTHER SERVICES PROVIDED BY US, YOU ACKNOWLEDGE THAT YOU HAVE READ THESE TERMS OF SERVICE AND AGREE TO BE BOUND BY THEM.
                        </p>

                        <h6>Contact Us</h6>
                        <p>
                            Please send your feedback, comments, requests for technical support by email: oasys-services@gmail.com.
                        </p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <script>
            function consent_checkbox_click(){
                var data_priv = document.getElementById('data_privacy_chk')
                var terms = document.getElementById('terms_condition_chk')
                var submit = document.getElementById('form_submit')


                if(data_priv.checked && terms.checked){
                    submit.disabled = false
                }else{
                    submit.disabled = true
                }
            }
        </script>
    @endsection
