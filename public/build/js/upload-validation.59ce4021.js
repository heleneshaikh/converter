(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{oGi1:function(e,t){var n=document.querySelector(".button__input--csv"),o=document.querySelector(".button__input--xlsx"),i=document.querySelector(".form"),r=function(e){return function(){var t=this.files[0].type;t!==e?this.parentElement.insertAdjacentHTML("afterend",'<span class="form-error">'+t.substring(t.indexOf("/")+1)+" is not allowed. Please upload "+e.substring(e.indexOf("/")+1)+" only </span>"):(i.submit(),this.value="",document.querySelector(".animation-wrapper").classList.add("js-completed"))}};function s(){document.querySelector(".animation-wrapper").classList.remove("js-completed")}o.addEventListener("click",function(){return s()}),n.addEventListener("click",function(){return s()}),o.addEventListener("input",r("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")),n.addEventListener("input",r("text/csv"))}},[["oGi1",0]]]);