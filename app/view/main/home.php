<?php
include __DIR__ . '/../share/header.php';

?>
<h4 class="ms-2">
    Welcome, 
    
</h4>
<!--------the cta section----------->
    <div class="container-fluid">
        
        <div class="row cta justify-content-center ">
            <div class="cta-blur"></div>
            <div>
                <h5>PATIENT PORTAL</h5><br>
                <h1>Book Care That Fits <br> Your Day<h1> 
                <h5>Search doctors by specciaty, check  real availability, <br> 
                    and confirm your appointment in under a minute,<br> No phone calls needed
                </h5>
                </div>
        </div>
    </div>
<!---------------the search bar section----------->
    <div class="row justify-content-center">
        <h2 class="text-center mt-3">Find a doctor</h2>
        <div class="col-12 col-md-8 col-lg-8 search">
            <input type="text" name="" class="form-control" placeholder="Search doctor name" 
                                        id="" onkeyup="searchDoctor(this, 'doc')">
            <i class="bi bi-search"></i>
        </div>
        <div class="col-12 col-md-4 col-lg-4 mt-2 d-flex click-search">
            <span>
                <select name="" id="" class="form-control">
                    <option value="All speciaties">All speciaties</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Pediatrics">Pediatrics</option>
                    <option value="Dermatology">Dermatology</option>
                    <option value="Orthapedics">Orthapedics</option>
                    <option value="General Medecine">General Medecine</option>
                </select>
            </span>

            <button id="search-button">Search</button>
        </div>
    </div>
   <!---------the card section--------->
   <div class="container-fluid mt-5" id="card_section">
    <div class="row justify-content-center">
        <h3 class="ms-3" id="today-head">AVAILABLE TODAY</h3>
        <h1 class="ms-3">Doctors ready to see you</h1>

        <div class="cards">

            <?php foreach ($doctors as $doc): ?>
            <div class="card shadow">
                <div class="image">
                    <img src="<?=  htmlspecialchars($doc['profile_photo']) ?>"
                        class="card-img-top"
                         alt="Doctor">
                         
                </div>

                <div class="card-body">
                    <h6 class="card-title"><b><?php echo $doc['username']; ?></b></h6>
                    <p class="card-text"><?php echo $doc['specialty']; ?></p>
                </div>

                <button class="card-foot btn btn-outline-light text-light" 
                 onclick="openBooking('<?php echo $doc['doctor_id']; ?>',
                                    '<?php echo $doc['username']; ?>', 
                                     '<?php echo $doc['specialty']; ?>', 
                                     '<?php echo $doc['profile_photo']; ?>')">Book appointment</button>
            </div>
                <?php endforeach; ?>
         </div>

        </div>
    </div>
   </div> 

   <div>
        <div class="modal fade" id="mod" tabindex="1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book appointment</h5>
                         <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
 <form action="?action=confirmBooking" method="POST">

    <div class="modal-body">

        <input type="hidden" name="doctor_id" id="doctorId">

        <div class="text-center mb-3">
            <div class="imageMod">
                <img src="" id="doctorPhoto" alt="">
            </div>

            <h6 class="mt-2">
                Booking with
                <strong id="modalDocName"></strong>
                —
                <span id="modalDocspec"></span>
            </h6>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input
                type="date"
                name="appointment_date"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Time slot</label>

            <select
                name="appointment_time"
                class="form-select"
                required>

                <option value="">Choose a time</option>
                <option value="08:30:00">08:30 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="13:00:00">01:00 PM</option>
                <option value="15:30:00">03:30 PM</option>
                <option value="17:30:00">05:30 PM</option>

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Reason for visit</label>

            <textarea
                name="reason"
                class="form-control"
                rows="3"
                placeholder="Briefly describe your reason for visiting"
                required></textarea>
        </div>

    </div>

    <div class="modal-footer">

        <button
            class="btn btn-outline-danger"
            type="button"
            data-bs-dismiss="modal">
            Close
        </button>

        <button
            class="btn btn-success"
            type="submit"
            name="book">
            Confirm booking
        </button>

        </div>

    </form>  
            </div>
        </div>
    <div>

    </div>
   </div>

   <!--------------the process section ---------------->
   <div class="row mt-5 row-process" id="help_section">

        <h2 id="process" class="ms-3">process</h2>
        <h1 class="ms-3">Three steps to your appointment</h1>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="shadow processes">
                <div id="round"><p>1</p></div><br>
                <h4><b>search</b></h4>
                <p>Filter by speciaty or search a doctor's name directly.</p>
            </div>
        </div>
        
        <div class="col-12 col-md-6 col-lg-4">
            <div class="shadow processes">
                <div id="round"><p>2</p></div><br>
                <h4><b>Select a time</b></h4>
                <p>Pick an open slot from the doctor's real schedule.</p>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="shadow processes">
                <div id="round"><p>3</p></div><br>
                <h4><b>Confirm</b></h4>
                <p>Get a confirmation and track status from your dashboard</p>
            </div>
        </div>
   </div>
    <br><br>
 
<?php

include __DIR__ . '/../share/footer.php';
?>