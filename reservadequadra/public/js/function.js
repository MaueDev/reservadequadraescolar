function redirect(string) {
  switch (string) {
    case 1:
      window.location.href = "index.php?fazerlogin=login&home=home";
      break;
    case 2:
      window.location.href = "index.php?fazerlogin=login&home=config";
      break;
      case 3:
        window.location.href = "doLogout.php";
        break;
    case 4:
        window.open('http://www.linkedin.com/in/mauricio-rodrigues-MΛUΞ','_blank');
        break;
    case 11:
        window.location.href = "../ga/index.php";
        break;
    default:

  }
}
