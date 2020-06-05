package fina.student.smartgarbage;

import java.util.ArrayList;
import java.util.List;

public class dataProvider {
    private static final dataProvider ourInstance = new dataProvider();

    public static dataProvider getInstance() {
        return ourInstance;
    }
    List<LocationModel> locationModelList=new ArrayList<>();
    private dataProvider() {
    }
}
