import { Component, OnInit } from "@angular/core";
import { Router } from "@angular/router";

@Component({
    selector: "app-checkout",
    templateUrl: "./checkout.component.html",
    styleUrls: ["./checkout.component.css"]
})
export class CheckoutComponent implements OnInit {
    public price: any;

    constructor(private router: Router) {}

    ngOnInit() {}

    public onMenuButtonClicked(): void {
        this.router.navigate(["selection"]);
    }

    public onCheckoutButtonClicked(): void {}
}
