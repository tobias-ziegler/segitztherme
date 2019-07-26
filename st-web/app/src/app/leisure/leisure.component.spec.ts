import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LeisureComponent } from './leisure.component';

describe('LeisureComponent', () => {
  let component: LeisureComponent;
  let fixture: ComponentFixture<LeisureComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LeisureComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LeisureComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
