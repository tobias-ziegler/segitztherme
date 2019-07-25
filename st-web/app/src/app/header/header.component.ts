import { Component, OnInit, Input } from "@angular/core";

/**
 * This component represents the app header.
 */
@Component({
    selector: "app-header",
    templateUrl: "./header.component.html",
    styleUrls: ["./header.component.css"]
})
export class HeaderComponent implements OnInit {
    @Input()
    public isLanding: boolean;

    constructor() {}

    ngOnInit() {}
}
