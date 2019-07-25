import { Component, OnInit } from "@angular/core";
import { Router, ActivatedRoute } from "@angular/router";

@Component({
    selector: "app-selection",
    templateUrl: "./selection.component.html",
    styleUrls: ["./selection.component.css"]
})
export class SelectionComponent implements OnInit {
    constructor(
        private activatedRoute: ActivatedRoute,
        private router: Router
    ) {}

    ngOnInit() {
        console.log("configured routes: ", this.router.config);
    }

    public onMasterDataButtonClicked(): void {
        this.router.navigate(["/masterdata"]);
    }

    public onCheckinButtonClicked(): void {
        this.router.navigate(["/checkin"]);
    }

    public onRestaurantButtonClicked(): void {
        this.router.navigate(["/restaurant"]);
    }

    public onCheckoutButtonClicked(): void {
        this.router.navigate(["/checkout"]);
    }

    public onStatisticsButtonClicked(): void {
        this.router.navigate(["/statistics"]);
    }
}
