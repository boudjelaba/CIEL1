window.onload = function () {
  document.getElementById("telecharger")
    .addEventListener("click", () => {
      const contenu = this.document.getElementById("contenu");
      contenu.classList.add("pdf");//
      console.log(contenu);
      console.log(window);
      var opt = {
        margin: 0.25,
        filename: 'contenu.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      };
      html2pdf().from(contenu).set(opt).save();
      setTimeout(function(){
          location.reload();
      }, 5000);
    });
  }