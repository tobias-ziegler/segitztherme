import { PrintService } from "./../../service/print.service";
import { Component, OnInit } from "@angular/core";
import { Router } from "@angular/router";
import { HttpClient } from "@angular/common/http";

@Component({
    selector: "app-checkout",
    templateUrl: "./checkout.component.html",
    styleUrls: ["./checkout.component.css"]
})
export class CheckoutComponent implements OnInit {
    public price: any;

    constructor(
        private httpClient: HttpClient,
        private router: Router,
        private printService: PrintService
    ) {}

    ngOnInit() {}

    public onMenuButtonClicked(): void {
        this.router.navigate(["selection"]);
    }

    public onCheckoutButtonClicked(): void {
        this.price = JSON.parse(sessionStorage.getItem("cartTotal"))["total"];
        this.httpClient
            .post("http://localhost:80/api/CheckOut.php", JSON.stringify({}))
            .subscribe(() => {
                window.location.reload();
            });
    }

    public onPrintButtonClicked(): void {
        this.printService.printCheckoutReceipt(
            JSON.parse(sessionStorage.getItem("cart")),
            JSON.parse(sessionStorage.getItem("cartTotal"))["total"]
        );
    }
}
