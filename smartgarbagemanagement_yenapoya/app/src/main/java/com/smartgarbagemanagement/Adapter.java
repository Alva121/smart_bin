package com.smartgarbagemanagement;

import android.graphics.Color;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.List;

/**
 * Created by scchethu on 08/04/2018.
 */

public class Adapter extends RecyclerView.Adapter<Adapter.MyViewHolder> {
    private List<binModel> binList;
    ViewGroup parent;
    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView name, dist,status;
        public MyViewHolder(View view) {
            super(view);
            name= (TextView) view.findViewById(R.id.name);
            dist = (TextView) view.findViewById(R.id.distance);
            status = (TextView) view.findViewById(R.id.status);
        }
    }
    public Adapter(List<binModel> binList) {
        this.binList = binList;
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.garbage_bins, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {
        binModel cl =binList.get(position);
        holder.dist.setText(cl.getDist());
       holder.name.setText(cl.getName());
        holder.status.setText(cl.getStatus());

         if(position==0)
         {
            
             holder.name.setTextColor(Color.parseColor("#ffa340"));
             holder.dist.setTextColor(Color.parseColor("#ffa340"));
             holder.status.setTextColor(Color.parseColor("#ffa340"));
         }

           if (holder.status.getText().toString().contains("Empty"))
           {
               holder.status.setTextColor(Color.GREEN);
           }else if (holder.status.getText().toString().contains("Medium"))
           {
               holder.status.setTextColor(Color.YELLOW);
           }else if (holder.status.getText().toString().contains("FULL"))
           {
               holder.status.setTextColor(Color.RED);
           }


    }

    @Override
    public int getItemCount() {
        return binList.size();
    }
}
