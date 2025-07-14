document.querySelectorAll(".logout").forEach((e) => {
    e.onclick = (el) => {
        console.log("chamou")
        el.preventDefault();
        sessionStorage.clear();
        window.location.href = "./logout.php";
    }
})