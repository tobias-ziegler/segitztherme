import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SaunaComponent } from './sauna.component';

describe('SaunaComponent', () => {
  let component: SaunaComponent;
  let fixture: ComponentFixture<SaunaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SaunaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SaunaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
