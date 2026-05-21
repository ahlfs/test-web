export default class BankAccount {
  #balance = 0;
  constructor(owner) {
    this.owner = owner;
  }

  deposit(amount) {
    this.#balance += amount;
    console.log(`${this.owner} menabung sejumlah Rp.${amount}`);
  }

  withdraw(amount) {
    if (this.#balance < amount) {
      console.log(`saldo gacukup woii`);
    } else {
      this.#balance -= amount;
      console.log(
        `${this.owner} mengambil sejumlah Rp.${amount} menyisakan Rp.${this.#balance} di saldonya`,
      );
    }
  }

  getBalance() {
    return this.#balance;
  }
}
