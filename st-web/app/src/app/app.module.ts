import { HomeComponent } from "./home/home.component";
import { BrowserModule } from "@angular/platform-browser";
import { HttpClientModule } from "@angular/common/http";
import { NgModule } from "@angular/core";
import { RouterModule, Routes } from "@angular/router";
import { AppComponent } from "./app.component";
import { HeaderComponent } from "./header/header.component";
import { HeroBannerComponent } from "./hero-banner/hero-banner.component";
import { AboutComponent } from "./about/about.component";
import { PricesComponent } from "./prices/prices.component";
import { ContactComponent } from "./contact/contact.component";
import { FooterComponent } from "./footer/footer.component";
import { LoginComponent } from "./admin/login/login.component";
import { SelectionComponent } from "./admin/selection/selection.component";
import { CommonModule } from "@angular/common";
import { FormsModule } from "@angular/forms";
import { MasterdataComponent } from "./admin/masterdata/masterdata.component";
import { CheckinComponent } from "./admin/checkin/checkin.component";
import { CheckinSuccesfulComponent } from "./admin/checkin-succesful/checkin-succesful.component";
import { RestaurantComponent } from "./admin/restaurant/restaurant.component";
import { StatisticsComponent } from './admin/statistics/statistics.component';

const appRoutes: Routes = [
    { path: "home", component: HomeComponent },
    { path: "login", component: LoginComponent },
    { path: "selection", component: SelectionComponent },
    { path: "masterdata", component: MasterdataComponent },
    { path: "checkin", component: CheckinComponent },
    { path: "restaurant", component: RestaurantComponent },
    { path: "", redirectTo: "/home", pathMatch: "full" },
    { path: "**", redirectTo: "/home", pathMatch: "full" }
];

@NgModule({
    declarations: [
        AppComponent,
        HomeComponent,
        HeaderComponent,
        HeroBannerComponent,
        AboutComponent,
        PricesComponent,
        ContactComponent,
        FooterComponent,
        LoginComponent,
        SelectionComponent,
        MasterdataComponent,
        CheckinComponent,
        CheckinSuccesfulComponent,
        RestaurantComponent,
        StatisticsComponent
    ],
    imports: [
        BrowserModule,
        CommonModule,
        HttpClientModule,
        FormsModule,
        RouterModule.forRoot(appRoutes)
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule {}
