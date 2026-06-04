import Student from "./models/Student.js";
import Person from "./models/Person.js";
import BankAccount from "./models/BankAccount.js";

const mhs1 = new Student('Alul', 21, "241110014", "Informatika");
mhs1.greet();
mhs1.study();

const rekeningMhs = new BankAccount(mhs1.name);
rekeningMhs.deposit(20000);
rekeningMhs.withdraw(1000);

document.getElementById("output").innerHTML =
` 
<h2>Data Mahasiswa</h2><br>
<p><strong>Nama : </strong> ${mhs1.name}</p><br>
<p><strong>NIM : </strong> ${mhs1.nim}</p><br>
<p><strong>Umur : </strong> ${mhs1.age}</p><br>
<p><strong>Jurusan : </strong> ${mhs1.major}</p><br>
<p><strong>Saldo : </strong> ${rekeningMhs.getBalance().toLocaleString('id-ID')}</p><br>
`