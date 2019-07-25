import { Router } from "@angular/router";
import { Component, OnInit } from "@angular/core";

@Component({
    selector: "app-statistics",
    templateUrl: "./statistics.component.html",
    styleUrls: ["./statistics.component.css"]
})
export class StatisticsComponent implements OnInit {
    constructor(private router: Router) {}

    ngOnInit() {}

    public onMenuButtonClicked() {
        this.router.navigate(["selection"]);
    }
}
