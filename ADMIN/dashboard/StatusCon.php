<?php
    
    require "../../Database/db.php";
    

    $sql = "SELECT * FROM june WHERE (StatusRemarks = 'Final' AND Status = 'pending')";
    $result = mysqli_query($conn,$sql);
    

    //Admin function, (Pending,Deleted,Approved,Rejected)

    if(isset($_POST['admin_approve'])){
        $id = $_POST['editId'];
        $sql = "UPDATE june SET Status = 'approved' WHERE id = $id";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo '<script>alert("Approved Successfully!")</script>';
            echo '<script>window.location.href="dashboard.php"</script>';
        }
    }

    if(isset($_POST['admin_reject'])){
        $id = $_POST['editId'];
        $sql = "UPDATE june SET Status = 'rejected' WHERE id = $id";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo '<script>alert("Rejected Successfully!")</script>';
            echo '<script>window.location.href="dashboard.php"</script>';
        }
    }

    if(isset($_POST['admin_pending'])){
        $id = $_POST['editId'];
        $sql = "UPDATE june SET Status = 'pending' WHERE id = $id";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo '<script>alert("Updated Successfully!")</script>';
            echo '<script>window.location.href="dashboard.php"</script>';
        }
    }

    if(isset($_POST['admin_delete'])){
        $id = $_POST['editId'];
        $sql = "DELETE FROM june WHERE id = $id";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo '<script>alert("Deleted Successfully!")</script>';
            echo '<script>window.location.href="dashboard.php"</script>';
        }
    }

    //CyberSecurity
    if(isset($_GET['cyber_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Cybersecurity' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['cyber_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Cybersecurity' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['cyber_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Cybersecurity' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }


   //DJPH
   if(isset($_GET['djph_pending'])){
    $project = $_SESSION["project"];
    $sql = "SELECT * FROM june WHERE project = 'DJPH' AND StatusRemarks = 'Final' AND Status = 'pending'";
    $result = mysqli_query($conn,$sql);

    if($result or die(mysqli_error($conn))){
        
    }
    
    }
    if(isset($_GET['djph_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'DJPH' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['djph_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'DJPH' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //eBPLS
    if(isset($_GET['ebpls_pending'])){
    $project = $_SESSION["project"];
    $sql = "SELECT * FROM june WHERE project = 'eBPLS' AND StatusRemarks = 'Final' AND Status = 'pending'";
    $result = mysqli_query($conn,$sql);

    if($result or die(mysqli_error($conn))){
        
    }
    
    }
    if(isset($_GET['ebpls_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'eBPLS' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['ebpls_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'eBPLS' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    } 

    //wifi for all
    if(isset($_GET['wifi_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Free Wi-Fi for All' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['wifi_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Free Wi-Fi for All' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['wifi_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Free Wi-Fi for All' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    
    //GOSD
    if(isset($_GET['gosd_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GOSD' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['gosd_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GOSD' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['gosd_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GOSD' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }


    //GovNet
    if(isset($_GET['govnet_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GovNet' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['govnet_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GovNet' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['govnet_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GovNet' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //IIDB
    if(isset($_GET['iidb_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'IIDB' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['iidb_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'IIDB' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['iidb_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'IIDB' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //ILCDB
    if(isset($_GET['ilcdb_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'ILCDB' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['ilcdb_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'ILCDB' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['ilcdb_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'ILCDB' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }


    //Information Division
    if(isset($_GET['information_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Information Division' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['information_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Information Division' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['information_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Information Division' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //PNPKI
    if(isset($_GET['pnpki_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'PNPKI' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['pnpki_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'PNPKI' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['pnpki_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'PNPKI' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //Tech4ED
    if(isset($_GET['tech4ed_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Tech4ED' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['tech4ed_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Tech4ED' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['tech4ed_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Tech4ED' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //VIMS
    if(isset($_GET['vims_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'VIMS' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['vims_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'VIMS' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['vims_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'VIMS' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }


    //GVCS
    if(isset($_GET['gvcs_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GVCS' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
    
    }
    if(isset($_GET['gvcs_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GVCS' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['gvcs_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GVCS' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);

        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //DRRM
    if(isset($_GET['drrm_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'DRRM' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['drrm_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'DRRM' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['drrm_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'DRRM' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //National Broadband
    if(isset($_GET['national_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'National Broadband Plan' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['national_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'National Broadband Plan' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['national_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'National Broadband Plan' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //GAD
    if(isset($_GET['gad_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GAD' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['gad_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GAD' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['gad_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'GAD' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }

    //Senior Citizens/PWDs
    if(isset($_GET['senior_pending'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Senior Citizens/PWDs' AND StatusRemarks = 'Final' AND Status = 'pending'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['senior_approved'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Senior Citizens/PWDs' AND StatusRemarks = 'Final' AND Status = 'approved'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }
    if(isset($_GET['senior_rejected'])){
        $project = $_SESSION["project"];
        $sql = "SELECT * FROM june WHERE project = 'Senior Citizens/PWDs' AND StatusRemarks = 'Final' AND Status = 'rejected'";
        $result = mysqli_query($conn,$sql);
    
        if($result or die(mysqli_error($conn))){
            
        }
        
    }



?>