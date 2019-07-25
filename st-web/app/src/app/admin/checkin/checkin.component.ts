import { HttpClient } from "@angular/common/http";
import { Router } from "@angular/router";
import { Component, OnInit } from "@angular/core";

@Component({
    selector: "app-checkin",
    templateUrl: "./checkin.component.html",
    styleUrls: ["./checkin.component.css"]
})
export class CheckinComponent implements OnInit {
    private prices: any;
    public selectedPrice: any;

    constructor(private httpClient: HttpClient, private router: Router) {}

    ngOnInit() {
        this.httpClient
            .get("http://localhost:80/api/entrance/get.php")
            .subscribe(response => {
                this.prices = response;
                console.log(response);
            });
    }

    public setSelectedPrice(price: any): void {
        this.selectedPrice = price;
    }

    public onMenuButtonClicked() {
        this.router.navigate(["selection"]);
    }
}
