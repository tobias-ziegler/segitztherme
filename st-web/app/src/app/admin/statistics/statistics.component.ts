import { Router } from "@angular/router";
import { Component, OnInit } from "@angular/core";
import { HttpClient } from "@angular/common/http";

@Component({
    selector: "app-statistics",
    templateUrl: "./statistics.component.html",
    styleUrls: ["./statistics.component.css"]
})
export class StatisticsComponent implements OnInit {
    public report1: any;
    public report2: any;
    public report3: any;
    public report4Winner: any;
    public report4Loser: any;
    public report5: any;
    public report6Customers: any;
    public report6Time: any;

    constructor(private httpClient: HttpClient, private router: Router) {}

    ngOnInit() {
        this.httpClient
            .get("http://localhost:80/api/reports/report1.php")
            .subscribe(response => {
                this.report1 = response["Badegaeste"];
            });

        this.httpClient
            .get("http://localhost:80/api/reports/report2.php")
            .subscribe(response => {
                this.report2 = response["Umsatz"] ? response["Umsatz"] : 0;
            });
        this.httpClient
            .get("http://localhost:80/api/reports/report3.php")
            .subscribe(response => {
                this.report3 = response["Umsatz"];
            });
        this.httpClient
            .get("http://localhost:80/api/reports/report4_renner.php")
            .subscribe(response => {
                this.report4Winner = response["Renner"];
            });
        this.httpClient
            .get("http://localhost:80/api/reports/report4_looser.php")
            .subscribe(response => {
                this.report4Loser = response["Losser"];
            });
        this.httpClient
            .get("http://localhost:80/api/reports/report5.php")
            .subscribe(response => {
                this.report5 = response["Aufenthaltsdauer"];
            });
        this.httpClient
            .get("http://localhost:80/api/reports/report6_max.php")
            .subscribe(response => {
                this.report6Customers = response["AnzahlBesucher"];
                this.report6Time = response["stunde"];
            });
    }

    public onMenuButtonClicked() {
        this.router.navigate(["selection"]);
    }
}
