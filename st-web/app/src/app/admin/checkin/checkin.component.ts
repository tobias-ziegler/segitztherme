import { PrintService } from "./../../service/print.service";
import { HttpClient } from "@angular/common/http";
import { Router } from "@angular/router";
import { Component, OnInit, ViewChild } from "@angular/core";

@Component({
    selector: "app-checkin",
    templateUrl: "./checkin.component.html",
    styleUrls: ["./checkin.component.css"]
})
export class CheckinComponent implements OnInit {
    @ViewChild("employeeID", { static: false })
    public employeeID: any;

    public prices: any;
    public selectedPrice: any;

    constructor(
        private httpClient: HttpClient,
        private router: Router,
        private printService: PrintService
    ) {}

    ngOnInit() {
        this.httpClient
            .get("http://localhost:80/api/entrance/get.php")
            .subscribe(response => {
                this.prices = response;
            });
    }

    public setSelectedPrice(price: any): void {
        this.selectedPrice = price;
    }

    public onCheckinButtonClicked(): void {
        if (!this.selectedPrice) {
            return;
        }

        this.httpClient
            .post(
                "http://localhost:80/api/CheckIn.php",
                JSON.stringify({
                    priceId: this.selectedPrice.id,
                    employeeId: this.employeeID.nativeElement.value
                })
            )
            .subscribe(() => {
                window.location.reload(false);
            });
    }

    public onPrintButtonClicked(): void {
        this.printService.printCheckinReceipt(
            this.selectedPrice.preis,
            this.selectedPrice.kategorie
        );
    }

    public onMenuButtonClicked(): void {
        this.router.navigate(["selection"]);
    }
}
