import { Injectable } from "@angular/core";

@Injectable({
    providedIn: "root"
})
export class PrintService {
    constructor() {}

    public printCheckinReceipt(amount: number, kategorie: string): void {
        let win = window.open();
        win.document.write(
            "<html><div>**********</div><div>Segitz Therme</div><div>1 " +
                kategorie +
                ", Betrag: " +
                amount +
                "€</div><div>**********</div></html>"
        );
        win.print();
        win.close();
    }

    public printCheckoutReceipt(cart: any, total: any) {
        let receipt: string =
            "<html><div>**********</div><div>Segitz Therme</div>";

        for (let item of cart) {
            receipt +=
                "<div>" +
                item.count +
                "x " +
                item.bezeichnung +
                ", Betrag: " +
                item.preis +
                "€, Steuer: " +
                item.steuer +
                "%";
        }

        receipt += "<div>Gesamt: " + total + "€</div>";
        receipt += "<div>**********</div>";
        receipt += "</html>";

        let win = window.open();
        win.document.write(receipt);
        win.print();
        win.close();
    }
}
