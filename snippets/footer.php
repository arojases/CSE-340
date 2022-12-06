<p> ©PHP Motors. All rights reserved </p>
<p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will
    be removed</p>
<span>
    <script>
    var myDate = new Date(document.lastModified);
    
    myNewDate = new Intl.DateTimeFormat(
        "de-AT", {
            year: "numeric",
            month: "numeric",
            day: "numeric"
        }
    ).format(myDate).replace(/\./g, '-');

    document.writeln("Last updated " + myNewDate);
    </script>

</span>