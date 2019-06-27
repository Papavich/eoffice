
<div class="panel-heading">
    <span class="title elipsis">
    <div align="right">
        <button class="btn btn-blue btn-sm" onclick="printWindow('section-to-print')"><i class="fa et-printer"></i>Print &nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa et-download"></i>Download</button>
    </div>
    </span>
</div>

<script>

    function printWindow(divID)
    {

        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;



    }

    function printA()
    {
        a = document.getElementById("partB");
        a.style.display="none";
        a.style.visibility="hidden";
        window.print();
        a.style.visibility="visible";
        a.style.display="block";


    }

    function printB()
    {
        c = document.getElementById("partA");
        c.style.display="none";
        c.style.visibility="hidden";
        window.print();
        c.style.visibility="visible";
        c.style.display="block";

    }


</script>