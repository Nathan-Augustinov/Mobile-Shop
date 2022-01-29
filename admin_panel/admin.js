function CopyMe(oFileInput, sTargetID) {
    var arrTemp = oFileInput.value.split('\\');
    document.getElementById(sTargetID).value = arrTemp[arrTemp.length - 1];
}